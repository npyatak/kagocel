<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 9;

    public $new_email;
    public $imageFile;
    public $registerFields = ['name', 'phone', 'email', 'birthdateFormatted', 'birthdate'];
    public $semiRequiredFields = ['name', 'phone', 'email', 'birthdateFormatted'];
    public $birthdateFormatted;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthdateFormatted', 'phone', 'name', 'surname', 'image', 'ip', 'browser'], 'string', 'max' => 255],
            [['birthdate', 'referrer_id', 'email_subscribe'], 'integer'],
            [['soc'], 'string', 'max' => 2],
            //[['email'], 'unique'],
            [['email', 'new_email'], 'email', 'checkDNS' => true],
            [$this->registerFields, 'required', 'on'=>'register'],
            ['rulesCheckbox', 'compare', 'compareValue' => 1, 'operator' => '==', 'on' => ['missing_fields', 'register'], 'message' => 'Необходимо согласиться с правилами'],
            ['personalDataCheckbox', 'compare', 'compareValue' => 1, 'operator' => '==', 'on' => ['missing_fields', 'register'], 'message' => 'Необходимо согласиться на обработку персональных данных'],
            [$this->semiRequiredFields, 'required', 'on'=>'missing_fields'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BANNED]],
        ];
    }

    public function scenarios() 
    {
        $scenarios = parent::scenarios();
        $scenarios['update_email'] = ['new_email'];
        $scenarios['missing_fields'] = $this->semiRequiredFields;
        $scenarios['register'] = $this->registerFields;

        return $scenarios;
    }

    public function behaviors() 
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
        ];
    }

    public function beforeValidate()
    {
        if($this->birthdateFormatted) {
            $date = \DateTime::createFromFormat('d.m.Y', $this->birthdateFormatted);
            $this->birthdate = $date->getTimestamp();
        }
        
        if (parent::beforeValidate()) {
            return true;
        }
        return false;
    }

    public function beforeSave($insert) 
    {
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) 
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind() 
    {
        if($this->birthdate) {
            $date = new \DateTime();
            $date->setTimestamp($this->birthdate);
            $this->birthdateFormatted = $date->format('d.m.o');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'soc' => 'Соц.сеть',
            'sid' => 'ID соц.сети',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'image' => 'Изображение',
            'status' => 'Статус',
            'ip' => 'IP',
            'browser' => 'Браузер',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'rulesCheckbox' => 'Регистрируясь, я соглашаюсь с Правилами проведения Конкурса и подтверждаю, что мне есть 18 лет.',
            'personalDataCheckbox' => 'Я согласен на обработку моих персональных данных.',
            'birthdate' => 'Дата рождения',
            'email_subscribe' => 'Подписка на рассылку',
            'userStageScores' => 'Баллы за этапы',
        ];
    }

    public function getId() 
    {
        return $this->id;
    }

    public static function findIdentity($id) 
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) 
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getAuthKey() {}
    
    public function validateAuthKey($authKey) 
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByService($soc, $sid) 
    {
        return static::findOne(['soc' => $soc, 'sid' => $sid]);
    }

    public static function findByEmail($email) 
    {
        return static::findOne(['email' => $email]);
    }

    public function getMissingFields() {
        $res = [];
        foreach ($this->semiRequiredFields as $field) {
            if($this->$field == null) {
                $res[] = $field;
            }
        }

        return $res;
    }

    public function getDate() 
    {
        if($this->date_start && $this->date_end) {
            $dateTimeStart = new \DateTime;
            $dateTimeStart->setTimestamp($this->date_start);

            $dateTimeEnd = new \DateTime;
            $dateTimeEnd->setTimestamp($this->date_end);

            if($dateTimeEnd->format('Y') == $dateTimeEnd->format('Y')) {
                $date = $dateTimeStart->format('j').' '.$this->getMonth($dateTimeStart->format('n'), true).' — '.$dateTimeEnd->format('j').' '.$this->getMonth($dateTimeEnd->format('n'), true).' '.$dateTimeEnd->format('Y');
            } else {
                $date = $dateTimeStart->format('j').' '.$this->getMonth($dateTimeStart->format('n'), true).' '.$dateTimeEnd->format('Y').' — '.$dateTimeEnd->format('j').' '.$this->getMonth($dateTimeEnd->format('n'), true).' '.$dateTimeEnd->format('Y');
            }

            return $date;
        }
    }


    public function getMonth($monthId, $secondForm = false) 
    {
        return $secondForm ? $this->monthsArray[$monthId][1] : $this->monthsArray[$monthId][0];
    }

    public static function getStatusArray() 
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BANNED => 'Забанен',
        ];
    }


    public function getStatusLabel() 
    {
        return self::getStatusArray()[$this->status];
    }

    /**
     * Finds admin by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    /*public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }*/

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    /*public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }*/

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function getFullName() 
    {
        return $this->name.' '.$this->surname;
    }

    public function getRefLink() 
    {
        return Url::toRoute(['site/register', 'ref_id' => $this->id], true);
    }

    public function getAvatar() 
    {
        if($this->image) {
            return $this->image;
        } else {
            $stage = Stage::getCurrent(Stage::TYPE_MAIN);

            if($stage !== null) {
                $console = UserStageScore::find()->select('console')->where(['stage_id' => $stage->id, 'user_id' => $this->id])->asArray()->column();

                if($console) {
                    if($console[0] == UserStageScore::CONSOLE_XBOX) {
                        return '/img/ava/ava_bitwa_man_xbox.png';
                    } else {
                        return '/img/ava/ava_bitwa_man_ps.png';
                    }
                }
            } 

            return '/img/ava/ava_bitwa_man_default.png';
        }
    }

    public function getUnsubscribeCode() 
    {
        return md5('unsubscribe_'.$this->id);
    }

    public function getUnsubscribeLink()
    {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(['site/unsubscribe', 'user_id' => $this->id, 'code' => $this->unsubscribeCode]);
        //return Url::toRoute(['site/unsubscribe', 'user_id' => $this->id, 'code' => $this->unsubscribeCode], true);
    }

    public function isUnder18() 
    {      
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->modify('-18 years');

        return $date->format('U') < $this->birthdate ? true : false;
    }
}