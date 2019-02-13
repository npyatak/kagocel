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

		<div id="blocks">
		    <?php foreach ($winners as $i => $winner) {
		    	echo $this->render('_winner', ['i' => $i, 'winner' => $winner, 'stage' => $stage]);
		    }?>
		</div>

	    <div class="form-group">
    		<?= Html::a('Добавить', '#', ['id' => 'add-block', 'class' => 'btn btn-primary']) ?>
	        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
	    </div>
	
	<?php ActiveForm::end(); ?>
</div>

<?php $script = "
    $(document).on('click', '#add-block', function() {
        var i = $('.block').length;

        $.ajax({
            type: 'GET',
            data: 'i='+i,
            success: function (data) {
            	$('#blocks').append(data);
            }
        });

        return false;
    });

    $(document).on('click', '.block .remove', function() {
    	$(this).closest('.block').remove();
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>