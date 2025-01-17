<?php
\frontend\assets\MixerAsset::register($this);
use yii\widgets\ActiveForm;
?>


<div class="mixer" id="mixer">
	<div class="mixer_inner" id="mixer__inner">
		<div class="mixer_top">
			
			<!-- при добавлянии класса active когда начинается запись скрываем .text , и показываем timer + меняется цвет-->
			<div class="recording_button black_gray" id="mixer__record-button" data-ga-click="click_record_button">
				<p class="text">Начать запись</p>
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
				<div class="spectr spectrogram" id="mixer__first-seek">
				</div>
				
				<div style="margin-top: 30px;">
					<div style="width: 100%; max-width: 100%;" id="mixer__loop-line-control-first" class="record_slider_horizontal_1"></div>
				</div>
			</div>

			<div class="mixer_top_item right rightTrack">
				<div>
					<p class="name">
						<span><strong id="mixer__second-track-name"></strong></span>
					</p>
					<!-- <p class="album"></span>Исполнитель - альбом</span></p> -->
					<p class="timer"><span class="played"  id="mixer__second-track-played">0:00</span> / <span class="duration" id="mixer__second-track-duration">00:00</span></p>
				</div>
				<div class="spectr" id="mixer__second-seek">
					<!-- <img src="/img/test_img/graph.png" alt=""> -->
				</div>
				<div style="margin-top: 30px;">
					<div style="width: 100%; max-width: 100%;" id="mixer__loop-line-control-second" class="record_slider_horizontal_1"></div>
				</div>
			</div>

		</div>
		<!-- mixer_top -->


		<div class="mixer_bottom">

			<div class="mixer_bottom_item">
				<div class="plate_wrap">
					<img class="plate" id="plate__first" src="/img/plate_1.png" alt="img">
					<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
					<img class="handle leftTrack" id="first-handle" src="/img/plate_handle.png" alt="img">
				</div>
				
				<div class="record_buttons">
					
					<div class="plus_minus" id="plus-minus__first">
						<div class="minus black_gray">-</div>
						<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> <span id="mixer__first-retweet">0</span></div>
						<div class="plus black_gray">+</div>
					</div>

					<div class="play_stop black_gray trackLeft" id="mixer__first-track-play-button">
						<i class="fa fa-play" aria-hidden="true"></i>
						<img class="fa-pause" src="/img/pause.svg" alt="pause">
					</div>

				</div>
				<div class="record_slider_horizontal_1" style="margin-top: 40px;">
					<p><span id="first__bpm"></span>bpm (скорость)</p>
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
							<p class="name">Миды</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="mixer__first-track-bass-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">Басы</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="mixer__first-track-high-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">Высокие</p>
						</div>
					</div>
					<!-- mbi_item -->


					<div class="mbi_item">
						<div style="text-align: center">Громкость</div>
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
							<p class="name">Миды</p>
						</div>


						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="mixer__second-track-bass-filter" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">Басы</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="mixer__second-track-high-filter" class="knob"></div>
							<span class="shadow black_gray"></span>
							<p class="name">Высокие</p>
						</div>
					</div>
					<!-- mbi_item -->

					<div class="record_slider_horizontal_2">
						<div id="mixer__balance-control"></div>
					</div>
						<div class="recording_button black_gray" id="mixer__reset-settings" style="margin: 20px auto; align-self: center;" data-ga-click="click_record_button">
							<p class="text">Сбросить настройки</p>
							<p class="timer" id="mixer__record-timer">0:00:00</p>
						</div>

				</div>
				<!-- mbi_wrap_items -->

			</div>
			<!-- mixer_bottom_item -->



			<div class="mixer_bottom_item">
				<div class="plate_wrap">
					<img class="plate" src="/img/plate_2.png" id="plate__second" alt="img">
					<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
					<img class="handle rightTrack" id="second-handle" src="/img/plate_handle.png" alt="img">
				</div>
				
				<div class="record_buttons">
					<div class="play_stop black_gray orange rightLeft" id="mixer__second-track-play-button">
						<i class="fa fa-play" aria-hidden="true"></i>
						<img class="fa-pause" src="/img/pause.svg" alt="pause">
					</div>

					<div class="plus_minus orange" id="plus-minus__second">
						<div class="minus black_gray">-</div>
						<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> <span id="mixer__second-retweet"> 0</span></div>
						<div class="plus black_gray">+</div>
					</div>
					
				</div>
				<div class="record_slider_horizontal_1" style="margin-top: 40px;">
					<p><span id="second__bpm"></span>bpm (скорость)</p>
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


	<div class="mixer_done-message" id="mixer__done-message">
		<h3 class="your_mix_name">Вы успешно создали свой микс!</h3>
		<div class="center">
			<a class="refer_style" style="color: #f7323f" id="mixer__listen-second" href="javascript:void(0)">Прослушать результат</a>
		</div>
		<div class="track_item light your_track" id="post_999" data-id="999">
			<audio id="result-src-cont" src=""></audio>
			<div class="spectrogram"></div>
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
				<div class="play" id="mixer__result-play-button">
					<i class="fa fa-play" aria-hidden="true"></i>
					<img class="fa-pause" src="/img/pause.svg" alt="pause">
				</div>
				<img src="/img/record.png" alt="img">
			</div>
			<div class="record_info">
				<div class="top">
					<!-- <span class="date">4 мар.</span> -->
					<!-- <p>Трек №1</p> -->
				</div>
				<a id="resultSend" href="javascript:void(0)" class="track_vote action  active" data-type="1">
					<p class="vote">отправить <img src="/img/arrow_white.svg" alt="img"></p>
				</a>
			</div>
		</div>
		<!-- track_item -->
		<div class="center">
			<a class="refer_style" id="tryAgain" href="javascript:void(0)">Попробовать снова</a>
		</div>

	</div>
	<!-- mixer_done-messages -->
