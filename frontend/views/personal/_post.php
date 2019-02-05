<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\PostAction;
?>

<div class="track_item">
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
			<i class="fa fa-pause" aria-hidden="true"></i>
		</div>
		<img src="/img/record.png" alt="img">
	</div>
	<div class="record_info">
		<div class="top">
			<span class="date">4 мар.</span>
			<p>Трек №1</p>
		</div>
		<div class="bottom">
			<p><span>Баллы:</span> <?=$post->score;?></p>
			<a class="link" href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
		</div>
	</div>
</div>
<!-- track_item -->