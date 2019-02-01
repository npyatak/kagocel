<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $id
 * @property string $name Имя
 * @property string $email E-mail
 * @property string $phone Телефон
 * @property string $body Телефон
 * @property int $status
 * @property int $created_at Время отправки
 */
class Contact extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_READ = 1;
    const STATUS_CLOSED = 9;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'email', 'phone', 'body'], 'string', 'max' => 255],
        ];
    }

    public function behaviors() 
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'body' => 'Сообщение',
            'status' => 'Статус',
            'created_at' => 'Время отправки',
        ];
    }

    public static function getStatusArray() 
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_READ => 'Прочитано',
            self::STATUS_CLOSED => 'Решено',
        ];
    }
}
