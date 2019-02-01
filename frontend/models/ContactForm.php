<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $body;
    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body', 'phone'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'E-mail',
            'phone' => 'Номер телефона',
            'body' => 'Сообщение',
            'verifyCode' => 'Проверочный код',
        ];
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer
            ->compose(
                ['html' => 'contactForm-html'],
                ['contactModel' => $this]
            )
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject('Сообщение с сайта')
            ->send();
    }
}