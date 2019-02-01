<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

class Post extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 5;

    public $_userActions;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'audio'], 'required'],
            [['user_id', 'score', 'status', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }  

    /*public function scenarios() {
        $scenarios = parent::scenarios();
        return $scenarios;
    }*/

    public function behaviors() 
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'stage_id' => 'Этап',
            'audio' => 'Аудио',
            'score' => 'Баллы',
            'status' => 'Статус',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
        ];
    }

    public function afterDelete() {
        $path = $this->audioSrcPath;
        if(file_exists($path.$this->audio) && is_file($path.$this->audio)) {
            unlink($path.$this->audio);
        }

        return parent::afterDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStage()
    {
        return $this->hasOne(Stage::className(), ['id' => 'stage_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostActions()
    {
        return $this->hasMany(PostAction::className(), ['post_id' => 'id']);
    }

    public function getUrl() 
    {
        return Url::toRoute(['/site/post', 'id' => $this->id]);
    }

    public function getAudioSrcPath() 
    {
        return __DIR__ . '/../../frontend/web/uploads/post/'.$this->user_id.'/';
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

    public function getUserActions() 
    {
        if($this->_userActions === null) {
            $this->_userActions = PostAction::find()
                ->select(['type'])
                ->where(['user_id' => Yii::$app->user->id, 'post_id' => $this->id])
                ->asArray()
                ->column();
        }

        return $this->_userActions;
    }

    public function userCan($type) 
    {
        return !in_array($type, $this->getUserActions());
    }
}
