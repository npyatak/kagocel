<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<?/*
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
*/?>



<!-- 
bg_1 - определяет фон блока и цвет шрифта внутри
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="feedback_section gradient_bg after_header">
    <div class="contain">
        


        <div class="feedback_wrap pt_small pb_big">
            <h2 class="section_title"><i>О</i>братная связь</h2>
            <p class="form_anons">Возникли вопросы? Напишите нам,</p>
            
            <div class="authorization_form_wrap">
                <form>
                    <div class="form-group">
                        <input class="input_1" type="text" placeholder="имя*">
                    </div>
                    <div class="form-group">
                        <input class="input_1" type="text" placeholder="фамилия*">
                    </div>
                    <!-- если поле не корректно заполнено добавляем к input класс failed и ниже в span выводим сообщение -->
                    <div class="form-group has-error">
                        <input class="input_1 failed" type="text" placeholder="e-mail*">
                        <span class="help-block">такой e-mail уже существует</span>
                    </div>
                    <div class="form-group">
                        <input class="input_1 phone_mask" type="text" placeholder="телефон">
                    </div>
                    <div class="form-group has-error">
                        <textarea class="textarea_1" placeholder="сообщение*"></textarea>
                        <span class="help-block">введите текст</span>
                    </div>
                </form>
                <p class="form_alert"><span>*</span>- обязательные для заполнения поля</p>

                <button class="button_bg black_gray"><span><i>О</i>тправить</span></button>
            
            </div>

        </div>
        <!-- feedback_wrap -->



    </div>
</section>
<!-- feedback_section -->