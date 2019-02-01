<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\PostAction;
?>

<div class="post track_item light" data-id="<?=$post->id;?>">
	<audio src="<?=$post->audio;?>"></audio>
	<div class="spectrogram">
		<!-- картинка просто для демонстрации!!! -->
		<img src="/img/test_img/graph.png" alt="">
	</div>
	<div class="timer_range">
		<p><span class="current">00:00</span> / <span class="duration">01:00</span></p>
	</div>
	<div class="volume_range_wrap">
		<img class="not_volume" src="/img/not_volume.svg" alt="icon">
		<input class="volume_range" type="text" id="example_id" name="example_name" value="" />
		<img class="go_volume" src="/img/volume.svg" alt="icon">
	</div>
	<div class="record_img">
		<div class="play">
			<i class="fa fa-play" aria-hidden="true"></i>
		</div>
		<img src="/img/record.png" alt="img">
	</div>
	<div class="record_info">
		<div class="top">
			<div class="name">
				<span class="img" style="background-image: url(<?=$post->user->image;?>);"></span>
				<p><?=$post->user->name;?></p>
			</div>
			<!-- <span>4 мар.</span> -->
		</div>
		<div class="bottom">
			<p><span>Баллы:</span> <span class="score"><?=$post->score;?></span></p>
			<div class="track_share">
				<a href="#" class="action icon fb <?=(Yii::$app->user->isGuest || $post->userCan(PostAction::TYPE_SHARE_FB)) ? 'active' : '';?>" data-type="<?=PostAction::TYPE_SHARE_FB;?>"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
				<a href="#" class="action icon vk <?=(Yii::$app->user->isGuest || $post->userCan(PostAction::TYPE_SHARE_VK)) ? 'active' : '';?>" data-type="<?=PostAction::TYPE_SHARE_VK;?>"><i class="fa fa-vk" aria-hidden="true"></i></a> 
				<a href="#" class="action icon ok <?=(Yii::$app->user->isGuest || $post->userCan(PostAction::TYPE_SHARE_OK)) ? 'active' : '';?>" data-type="<?=PostAction::TYPE_SHARE_OK;?>"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a> 
			</div>
		</div>

		<a class="track_vote action  <?=(!Yii::$app->user->isGuest && !$post->userCan(PostAction::TYPE_LIKE)) ? '' : 'active';?>" data-type="<?=PostAction::TYPE_LIKE;?>">
			<p class="vote" href="#">Голосовать <img src="/img/arrow_white.svg" alt="img"></p>
		</a>
	</div>
</div>
<!-- track_item -->