<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use common\models\User;

$this->registerJsFile('js/dateSelect.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->title = 'Заполните недостающие поля';
?>

<section class="authorization dark_bg bottom after_header min_h">
    <div class="contain">
        <div class="authorization_step_2">
            <h2 class="section_title">
                Авт<i>о</i>ризация
            </h2>
            
            <div class="authorization_form_wrap">


                <?php $form = ActiveForm::begin([
                    'id' => 'missing-fields-form',
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => true,
                ]); ?>


              
                <?php //if(in_array('name', $user->missingFields)):?>
                    <?= $form->field($user, 'name')->textInput(['class' => 'input_1', 'autofocus' => true, 'placeholder' => $user->attributeLabels()['name'].'*'])->label(false) ?>
                <?php //endif;?>
           
                <?php //if(in_array('surname', $user->missingFields)):?>
                    <?= $form->field($user, 'surname')->textInput(['class' => 'input_1', 'placeholder' => $user->attributeLabels()['surname'].'*'])->label(false) ?>
                <?php //endif;?>

                <p class="form_alert"><span>*</span>- обязательные для заполнения поля</p>
                <?= Html::submitButton('<span>Готово</span>', ['class' => 'button_1 point', 'name' => 'register-button']) ?>

                <?php ActiveForm::end(); ?>

                <!-- <a href="#" class="authoriation_refer">Авторизация</a> -->
            </div>

        </div>
        <!-- autorization_step_1 -->
    </div>
</section>