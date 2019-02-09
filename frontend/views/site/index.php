<!-- 
gradient_bg - задает градиент блоку
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="section_main gradient_bg after_header">
	<div class="decorate_letter">
		<img src="img/letter_o.png" alt="img">
	</div>

	<div class="contain pt_small">
		

		<div class="main_wrap_blocks and_button">
			<div class="wrap_big_img"><img class="big_img" src="img/packt.png" alt="img"></div>
			<div class="main_right">
				<p class="main_name">
					Прокачай свою заботу с кагоцел<i>о</i>м
				</p>
				<p class="anons">
					Создай свой уникальный музыкальный трек и получи шанс выиграть крутые призы! 
				</p>
				<a href="#" class="button_bg black_gray"><span>Участвовать</span></a>
			</div>
		</div>

	</div>
</section>
<!-- section_main -->

<section class="conditions_section pb_big">
	<div class="contain">

		<div class="section_top">
			<h3 class="section_name">Условия к<i>о</i>нкурса</h3>
		</div>

		<div class="conditions_wrap">
			<div class="item">
				<img src="/img/condition_1.svg" alt="img">
				<p>
					Создай свой музыкальный микс с помощью диджейского пульта.
				</p>
			</div>

			<div class="item">
				<img src="/img/condition_2.svg" alt="img">
				<p>
					Поделись своим творением в социальных сетях.
				</p>
			</div>

			<div class="item">
				<img src="/img/condition_3.svg" alt="img">
				<p>
					Каждую неделю мы выбираем<br> 5 победителей, которые получают крутые призы от Кагоцел!
				</p>
			</div>
		</div>

	</div>
</section>













<section class="video_section gradient_bg pt_big pb_big">
	<div class="contain">

		<div class="section_top">
			<h3 class="section_name">Когда тв<i>о</i>я девушка больна</h3>
			<p class="section_desc">Вдохновляйся этим роликом и создавай свой трек для любимых!</p>
		</div>



		<div class="video_player_wrap">
			<iframe id="video_player" width="720" height="405" src="//rutube.ru/play/embed/11982280?quality=1&platform=someplatform" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
		</div>


	</div>
</section>
<!-- video_section -->












<section class="mixer_main pt_big pb_big">
	<div class="contain">

		

		<div class="section_top">
			<h3 class="section_name">Создай св<i>о</i>й микс</h3>
			<a href="#" class="regulations_button">Правила пользования dj микшером</a>
		</div>



		<!-- MIXSER &&&&&&&&&&&&&&&&&&&&&&&&&&& -->
		<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->				

		<div class="mixer">
			<div class="mixer_inner">

				<div class="mixer_top">
					
					<!-- при добавлянии класса active когда начинается запись скрываем .text , и показываем timer + меняется цвет-->
					<div class="recording_button black_gray">
						<p class="text">Запись</p>
						<p class="timer">0:00:12</p>
					</div>


					<div class="mixer_top_item left">
						<div>
							<p class="name">
								<span><strong>Название песни</strong> Исполнитель - альбом</span>
							</p>
							<!-- <p class="album"><span>Исполнитель - альбом</span></p> -->
							<p class="timer">00:00 / 02:09</p>
						</div>
						<div class="spectr">
							<img src="/img/test_img/graph.png" alt="">
						</div>
					</div>

					<div class="mixer_top_item right">
						<div>
							<p class="name">
								<span><strong>Название песни</strong> Исполнитель - альбом</span>
							</p>
							<!-- <p class="album"></span>Исполнитель - альбом</span></p> -->
							<p class="timer">00:00 / 02:09</p>
						</div>
						<div class="spectr">
							<img src="/img/test_img/graph.png" alt="">
						</div>
					</div>

				</div>
				<!-- mixer_top -->


				<div class="mixer_bottom">

					<div class="mixer_bottom_item">
						<div class="plate_wrap">
							<img class="plate" src="/img/plate_1.png" alt="img">
							<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
							<img class="handle" src="/img/plate_handle.png" alt="img">
						</div>
						
						<div class="record_buttons">
							
							<div class="plus_minus">
								<div class="plus black_gray">-</div>
								<div class="center black_gray"><i class="fa fa-retweet" aria-hidden="true"></i> 4</div>
								<div class="minus black_gray">+</div>
							</div>

							<div class="play_stop black_gray">
								<i class="fa fa-play" aria-hidden="true"></i>
								<i class="fa fa-pause" aria-hidden="true"></i>
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
									<div id="" class="knob black_gray"></div>
									<p class="name">mid</p>
								</div>

								<div class="wrap_knob">
									<span class="grey_circle"></span>
									<span class="color_circle"></span>
									<div id="" class="knob black_gray"></div>
									<p class="name">bass</p>
								</div>

								<div class="wrap_knob">
									<span class="grey_circle"></span>
									<span class="color_circle"></span>
									<div id="" class="knob black_gray"></div>
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
									<div id="" class="knob black_gray"></div>
									<p class="name">mid</p>
								</div>

								<div class="wrap_knob">
									<span class="grey_circle"></span>
									<span class="color_circle orange"></span>
									<div id="" class="knob black_gray"></div>
									<p class="name">bass</p>
								</div>

								<div class="wrap_knob">
									<span class="grey_circle"></span>
									<span class="color_circle orange"></span>
									<div id="" class="knob black_gray"></div>
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
							<img class="plate" src="img/plate_2.png" alt="img">
							<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
							<img class="handle" src="img/plate_handle.png" alt="img">
						</div>
						
						<div class="record_buttons">
							<div class="play_stop black_gray orange">
								<i class="fa fa-play" aria-hidden="true"></i>
								<i class="fa fa-pause" aria-hidden="true"></i>
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



		<!-- //MIXSER &&&&&&&&&&&&&&&&&&&&&&&&& -->
		<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->


	</div>
</section>




<section class="you_prize gradient_bg pt_big pb_small">
	<div class="contain">

		<div class="section_top">
			<h3 class="section_name">Тв<i>о</i>и призы</h3>
			<p class="section_desc">май 2019</p>
		</div>

		<!-- <div class="wrap_prize">
			<div class="sticker">
				<img src="/img/sticker.svg" alt="img">
				<p class="prize_text">Главный приз</p>
			</div>
			<img class="prize" src="/img/prize.png" alt="img">
		</div> -->

	</div>
</section>
<!-- video_section -->





<div class="offers_block">
	<div class="offers">

		<div class="sticker">
			<img src="/img/sticker.svg" alt="img">
			<p class="set_text">
				<span>5</span>
				<span>наборов</span>
				<span>каждую неделю</span>
			</p>
		</div>

		<div class="offers_item type_1">
			<p class="name">Дождивик</p>
			<img src="/img/offer_1.png" alt="img">
		</div>
		<div class="offers_item type_2">
			<p class="name">Дождивики <br> на обувь</p>
			<img src="/img/offer_2.png" alt="img">
		</div>
		<div class="offers_item type_3">
			<p class="name">Свитшот</p>
			<img src="/img/offer_3.png" alt="img">
		</div>
	</div>
	<!-- offers -->
</div>