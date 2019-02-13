<?php
use yii\helpers\Html;

use common\models\Post;

$postsArray = [];
foreach (Post::find()->where(['stage_id' => $stage->id, 'post.status' => Post::STATUS_ACTIVE])->joinWith('user')->all() as $p) {
	$postsArray[$p->id] = $p->id.' - '.$p->user->fullName;
}
?>

<div class="row block">
	<?=Html::activeHiddenInput($winner, "[$i]id");?>
	<div class="col-sm-6">
		<div class="form-group <?=$winner->hasErrors("place") ? 'has-error' : '';?>">
			<?= Html::activeLabel($winner, "[$i]place", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($winner, "[$i]place", ['class' => 'form-control']) ?>
			<?= Html::error($winner, "[$i]place", ['class' => 'help-block']);?>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group <?=$winner->hasErrors("post_id") ? 'has-error' : '';?>">
			<?= Html::activeLabel($winner, "[$i]post_id", ['class' => 'control-label']) ?>
			<?= Html::activeDropdownList($winner, "[$i]post_id", $postsArray, ['class' => 'form-control']) ?>
			<?= Html::error($winner, "[$i]post_id", ['class' => 'help-block']);?>
		</div>
	</div>
	<div class="col-sm-1"><a href="#" class="remove" style="color: red;">Удалить</a></div>
</div>