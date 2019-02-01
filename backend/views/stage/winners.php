<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Stage;

$this->title = 'Победители. '.$stage->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="week-index">
	<?php $form = ActiveForm::begin([
	    'enableClientValidation' => true,
	    //'enableAjaxValidation' => true,
	]); ?>

	    <?php foreach ($winners as $i => $winner):?>
	    	<div class="row">
	        	<div class="col-sm-6">
					<div class="form-group <?=$winner->hasErrors("place") ? 'has-error' : '';?>">
						<?= Html::activeLabel($winner, "[$i]place", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($winner, "[$i]place", ['class' => 'form-control']) ?>
						<?= Html::error($winner, "[$i]place", ['class' => 'help-block']);?>
					</div>
				</div>
	        	<div class="col-sm-6">
					<div class="form-group <?=$winner->hasErrors("user_id") ? 'has-error' : '';?>">
						<?= Html::activeLabel($winner, "[$i]user_id", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($winner, "[$i]user_id", ['class' => 'form-control']) ?>
						<?= Html::error($winner, "[$i]user_id", ['class' => 'help-block']);?>
					</div>
				</div>
			</div>
	    <?php endforeach;?>

	    <div class="form-group">
	        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
	    </div>
	
	<?php ActiveForm::end(); ?>
</div>