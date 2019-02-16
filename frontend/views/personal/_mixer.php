<?php
\frontend\assets\MixerAsset::register($this);
?>


<div class="mixer">
	<div class="mixer_inner">

		<div class="mixer_top">
			
			<!-- при добавлянии класса active когда начинается запись скрываем .text , и показываем timer + меняется цвет-->
			<div class="recording_button black_gray">
				<p class="text">Запись</p>
				<p class="timer">0:00:00</p>
			</div>


			<div class="mixer_top_item left leftTrack">
				<div>
					<p class="name">
						<span><strong>Название песни</strong></span>
					</p>
					<!-- <p class="album"><span>Исполнитель - альбом</span></p> -->
					<p class="timer"><span class="played">0:00</span> / <span class="duration">00:00</span></p>
				</div>
				<canvas class="spectr">
					<img src="/img/test_img/graph.png" alt="">
				</canvas>
			</div>

			<div class="mixer_top_item right rightTrack">
				<div>
					<p class="name">
						<span><strong>Название песни</strong></span>
					</p>
					<!-- <p class="album"></span>Исполнитель - альбом</span></p> -->
					<p class="timer"><span class="played">0:00</span> / <span class="duration">00:00</span></p>
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
					<img class="handle leftTrack" src="/img/plate_handle.png" alt="img">
				</div>
				
				<div class="record_buttons">
					
					<div class="plus_minus">
						<div class="plus black_gray">-</div>
						<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> 4</div>
						<div class="minus black_gray">+</div>
					</div>

					<div class="play_stop black_gray trackLeft">
						<i class="fa fa-play" aria-hidden="true"></i>
						<img class="fa-pause" src="/img/pause.svg" alt="pause">
					</div>

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
							<div id="" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">mid</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">bass</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle"></span>
							<div id="" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">filter</p>
						</div>
					</div>
					<!-- mbi_item -->


					<div class="mbi_item">
						<div class="record_slider_horizontal_1">
							<p><span>140</span>bpm</p>
							<div class="rsh_1"></div>
						</div>
						<div class="wrap_record_slider_vertical">
							<!-- span высота визуального эквалайзера -->
							<div class="record_slider_vertical">
								<div class="rsv"></div>
								<div class="line"><span style="height: 5%"></span></div>
								<div class="line"><span style="height: 5%"></span></div>
							</div>
							<!-- span высота визуального эквалайзера -->
							<div class="record_slider_vertical">
								<div class="rsv"></div>
								<div class="line orange"><span style="height: 35%"></span></div>
								<div class="line orange"><span style="height: 35%"></span></div>
							</div>
						</div>
					</div>
					<!-- mbi_item -->


					<div class="mbi_item">
						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">mid</p>
						</div>


						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">bass</p>
						</div>

						<div class="wrap_knob">
							<span class="grey_circle"></span>
							<span class="color_circle orange"></span>
							<div id="" class="knob"></div>
							<span class	="shadow black_gray"></span>
							<p class="name">filter</p>
						</div>
					</div>
					<!-- mbi_item -->

					<div class="record_slider_horizontal_2">
						<div class="rsh_2"></div>
					</div>

				</div>
				<!-- mbi_wrap_items -->

			</div>
			<!-- mixer_bottom_item -->



			<div class="mixer_bottom_item">
				<div class="plate_wrap">
					<img class="plate" src="/img/plate_1.png" alt="img">
					<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
					<img class="handle rightTrack" src="/img/plate_handle.png" alt="img">
				</div>
				
				<div class="record_buttons">
					<div class="play_stop black_gray orange rightLeft">
						<i class="fa fa-play" aria-hidden="true"></i>
						<img class="fa-pause" src="/img/pause.svg" alt="pause">
					</div>

					<div class="plus_minus orange">
						<div class="plus black_gray">-</div>
						<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> 4</div>
						<div class="minus black_gray">+</div>
					</div>
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
