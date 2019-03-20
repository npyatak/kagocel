<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\PostAction;
?>

<div class="post track_item light" id="post_<?=$post->id;?>" data-id="<?=$post->id;?>">
	<audio src="<?=$post->audioFileUrl;?>"></audio>
	<div class="spectrogram"></div>
	<div class="timer_range">
		<p><span class="current">00:00</span> / <span class="duration"><?=$post->length;?></span></p>
	</div>
	<div class="volume_range_wrap">
		<img class="not_volume" src="/img/not_volume.svg" alt="icon">
		<div class="volume_range" id="example_id" name="example_name"></div>
		<!-- <input class="volume_range" type="text" id="example_id" name="example_name" value="" /> -->
		<img class="go_volume" src="/img/volume.svg" alt="icon">
	</div>
	<div class="record_img">
		<div class="play" data-ga-click="click_play_button">
			<i class="fa fa-play" aria-hidden="true"></i>
			<img class="fa-pause" src="/img/pause.svg" alt="pause">
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
            	<?=\frontend\widgets\share\ShareWidget::widget(['post' => $post]);?>
			</div>
		</div>

		<?php if(Yii::$app->user->isGuest) {
			$class = 'guest';
		} elseif(!Yii::$app->user->isGuest && !$post->userCan(PostAction::TYPE_LIKE)) {
			$class = '';
		} else {
			$class = 'active';
		}?>
		<a class="track_vote action  <?=$class;?>" data-type="<?=PostAction::TYPE_LIKE;?>"  data-ga-click="click_vote_button">
			<p class="vote">Голосовать</p>
		</a>
	</div>
</div>
<!-- track_item -->