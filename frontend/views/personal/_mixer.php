<?php
\frontend\assets\MixerAsset::register($this);
use yii\widgets\ActiveForm;
?>


<div class="mixer" id="mixer">
	<div class="mixer_inner" id="mixer__inner">

		<div class="mixer_top">
			
			<!-- при добавлянии класса active когда начинается запись скрываем .text , и показываем timer + меняется цвет-->
			<div class="recording_button black_gray" id="mixer__record-button">
				<p class="text">Запись</p>
				<p class="timer" id="mixer__record-timer">0:00:00</p>
			</div>


			<div class="mixer_top_item left leftTrack">
				<div>
					<p class="name">
						<span><strong id="mixer__first-track-name"></strong></span>
					</p>
					<!-- <p class="album"><span>Исполнитель - альбом</span></p> -->
					<p class="timer"><span class="played" id="mixer__first-track-played">0:00</span> / <span class="duration" id="mixer__first-track-duration">00:00</span></p>
				</div>
				<canvas class="spectr">
					<img src="/img/test_img/graph.png" alt="">
				</canvas>
			</div>

			<div class="mixer_top_item right rightTrack">
				<div>
					<p class="name">
						<span><strong id="mixer__second-track-name"></strong></span>
					</p>
					<!-- <p class="album"></span>Исполнитель - альбом</span></p> -->
					<p class="timer"><span class="played"  id="mixer__second-track-played">0:00</span> / <span class="duration" id="mixer__second-track-duration">00:00</span></p>
				</div>
				<canvas class="spectr">
					<img src="/img/test_img/graph.png" alt="">
				</canvas>
			</div>

		</div>
		<!-- mixer_top -->


		<div class="mixer_bottom">

			<div class="mixer_bottom_item">
				<div class="plate_wrap">
					<img class="plate" src="/img/plate_1.png" alt="img">
					<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
					<img class="handle leftTrack" id="first-handle" src="/img/plate_handle.png" alt="img">
				</div>
				
				<div class="record_buttons">
					
					<div class="plus_minus">
						<div class="plus black_gray">-</div>
						<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> 4</div>
						<div class="minus black_gray">+</div>
					</div>

					<div class="play_stop black_gray trackLeft" id="mixer__first-track-play-button">
						<i class="fa fa-play" aria-hidden="true"></i>
						<img class="fa-pause" src="/img/pause.svg" alt="pause">
					</div>

				</div>
				<div class="record_slider_horizontal_1" style="margin-top: 40px;">
					<p><span>140</span>bpm</p>
					<div id="mixer__first-track-playback-rate" class="rsh_1"></div>
				</div>
				<!-- record_buttons -->

			</div>
			<!-- mixer_bottom_item -->


			<div class="mixer_bottom_item">

				<div class="mbi_wrap_items">



					<div class="mbi_item">
						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="mixer__first-track-mid-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">mid</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="mixer__first-track-bass-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">bass</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="mixer__first-track-high-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">high</p>
						</div>
					</div>
					<!-- mbi_item -->


					<div class="mbi_item">
						<!-- <div class="record_slider_horizontal_1">
							<p><span>140</span>bpm</p>
							<div class="rsh_1"></div>
						</div> -->
						<div class="wrap_record_slider_vertical">
							<!-- span высота визуального эквалайзера -->
							<div class="record_slider_vertical">
								<div id="mixer__first-track-loudness-control"></div>
								<div class="line"><span id="mixer__first-track-loudness-line-1"></span></div>
								<div class="line"><span id="mixer__first-track-loudness-line-2"></span></div>
							</div>
							<!-- span высота визуального эквалайзера -->
							<div class="record_slider_vertical">
								<div id="mixer__second-track-loudness-control"></div>
								<div class="line orange"><span id="mixer__second-track-loudness-line-1"></span></div>
								<div class="line orange"><span id="mixer__second-track-loudness-line-2"></span></div>
							</div>
						</div>
					</div>
					<!-- mbi_item -->


					<div class="mbi_item">
						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="mixer__second-track-mid-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">mid</p>
						</div>


						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="mixer__second-track-bass-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">bass</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="mixer__second-track-high-filter" class="knob"></div>
							<span class="shadow black_gray"></span>
							<p class="name">high</p>
						</div>
					</div>
					<!-- mbi_item -->

					<div class="record_slider_horizontal_2">
						<div id="mixer__balance-control"></div>
					</div>

				</div>
				<!-- mbi_wrap_items -->

			</div>
			<!-- mixer_bottom_item -->



			<div class="mixer_bottom_item">
				<div class="plate_wrap">
					<img class="plate" src="/img/plate_2.png" alt="img">
					<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
					<img class="handle rightTrack" id="second-handle" src="/img/plate_handle.png" alt="img">
				</div>
				
				<div class="record_buttons">
					<div class="play_stop black_gray orange rightLeft" id="mixer__second-track-play-button">
						<i class="fa fa-play" aria-hidden="true"></i>
						<img class="fa-pause" src="/img/pause.svg" alt="pause">
					</div>

					<div class="plus_minus orange">
						<div class="plus black_gray">-</div>
						<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> 4</div>
						<div class="minus black_gray">+</div>
					</div>
				</div>
				<div class="record_slider_horizontal_1" style="margin-top: 40px;">
					<p><span>140</span>bpm</p>
					<div id="mixer__second-track-playback-rate" class="rsh_1"></div>
				</div>
				<!-- record_buttons -->

			</div>
			<!-- mixer_bottom_item -->

		</div>
		<!-- mixer_bottom -->

		

	</div>
	<!-- mixer_inner -->
</div>
<!-- mixer -->


<!-- нужно чтобы свойство display: none  задавалось не .mixer_inner а самому .mixer, чтобы убрать серую полосу-->

	<div class="mixer_done-message" id="mixer__done-message">
		<h3 class="your_mix_name">Вы успешно создали свой микс!</h3>
<!-- 		<div class="listen_done"><p>Хотите его прослушать?</p></div>
		<a id="tryAgain" href="#" style="background: #f7323f; padding: 10px 20px; color: #fff; display: inline-block; border-radius: 4px; margin: 20px;">Попробовать снова</a>
		<a id="resultSend" href="javascript:void(0)" style="background: #000; padding: 10px 20px; color: #fff; display: inline-block; border-radius: 4px; margin: 20px;">Отправить</a> -->




		<div class="track_item light your_track">
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
				<div class="volume_range" id="example_id" name="example_name"></div>
				<!-- <input class="volume_range" type="text" id="example_id" name="example_name" value="" /> -->
				<img class="go_volume" src="/img/volume.svg" alt="icon">
			</div>
			<div class="record_img">
				<div class="play">
					<i class="fa fa-play" aria-hidden="true"></i>
					<img class="fa-pause" src="/img/pause.svg" alt="pause">
				</div>
				<img src="/img/record.png" alt="img">
			</div>
			<div class="record_info">
				<div class="top">
					<span class="date">4 мар.</span>
					<p>Трек №1</p>
				</div>
				<a id="resultSend" href="javascript:void(0)" class="track_vote action  active" data-type="1">
					<p class="vote" href="#">отправить <img src="/img/arrow_white.svg" alt="img"></p>
				</a>
			</div>
		</div>
		<!-- track_item -->
		<div class="center">
			<a class="refer_style" id="tryAgain" href="#">Попробовать снова</a>
		</div>

	</div>
	<!-- mixer_done-messages -->