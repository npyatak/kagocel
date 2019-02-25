<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="feedback_section dark_bg bottom after_header min_h">
    <div class="contain">
        <div class="feedback_wrap pt_small pb_big">
            <h2 class="section_title"><i>О</i>братная связь</h2>
            <p class="form_anons">Возникли вопросы? Напишите нам,</p>
            

            <div class="authorization_form_wrap">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'input_1', 'placeholder' => 'имя*'])->label(false) ?>

                    <?= $form->field($model, 'email')->textInput(['class' => 'input_1', 'placeholder' => 'e-mail*'])->label(false) ?>

                    <?= $form->field($model, 'phone')->textInput(['class' => 'input_1', 'placeholder' => 'телефон'])->label(false) ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'class' => 'textarea_1', 'placeholder' => 'сообщение*'])->label(false) ?>

                    <!-- <div class="verify_wrap form-group"> -->
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '{image}{input}',
                    ])->label(false) ?>
                    <!-- </div> -->
                
                    <p class="form_alert"><span>*</span>- обязательные для заполнения поля</p>

                 
                    <?= Html::submitButton('<span>Отправить</span>', ['class' => 'button_1 point', 'name' => 'contact-button']) ?>
                 

                <?php ActiveForm::end(); ?>            
            </div>

        </div>
        <!-- feedback_wrap -->
    </div>
</section>
<!-- feedback_section -->