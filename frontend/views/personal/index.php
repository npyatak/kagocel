<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>



<!-- 
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="section_main after_header">
	<div class="decorate_letter">
		<img src="img/letter_o.png" alt="img">
	</div>

	<div class="contain pt_small">
		
		<div class="main_wrap_blocks">
			<div class="wrap_big_img"><img class="big_img" src="img/packt.png" alt="img"></div>
			<div class="main_right">
				<p class="main_name">
					Прокачай свою заботу с каг<i>о</i>цел
				</p>
				<p class="anons">
					Создай свой уникальный музыкальный трек и получи шанс выиграть крутые призы! 
				</p>
			</div>
		</div>

	</div>
</section>
<!-- section_main -->




<section class="mixer_section">
	<div class="contain">
		
		<div class="user_info">
			<div class="img" style="background-image: url(img/test_img/user_photo.png);"></div>
			<p class="name">Марченк<i>о</i>в Андрей</p>
			<a class="exit" href="#">Выйти <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>



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
							<p class="timer">00:00 / 02:09</p>
						</div>
						<div class="spectr">
							<img src="img/test_img/graph.png" alt="">
						</div>
					</div>

					<div class="mixer_top_item right">
						<div>
							<p class="name">
								<span><strong>Название песни</strong> Исполнитель - альбом</span>
							</p>
							<p class="timer">00:00 / 02:09</p>
						</div>
						<div class="spectr">
							<img src="img/test_img/graph.png" alt="">
						</div>
					</div>

				</div>
				<!-- mixer_top -->


				<div class="mixer_bottom">

					<div class="mixer_bottom_item">
						<div class="plate_wrap">
							<img class="plate" src="img/plate_1.png" alt="img">
							<!-- класс active отвечает за то что ручка находится на пластинке , если его убрать то ручка развернется -->
							<img class="handle" src="img/plate_handle.png" alt="img">
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


		<!-- //MIXSER &&&&&&&&&&&&&&&&&&&&&&&&&&& -->
		<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->



		<div class="mixer_playlist pb_big">

			<div class="playlist_left">
				<p class="playlist_name">Выбор песен</p>

				<div class="playlist">
					<ul>
						<li class="play_li">
							<div class="butt_wrap">
								<button class="button_play red"><i class="fa fa-play" aria-hidden="true"></i></button>
								<button class="button_play orange"><i class="fa fa-play" aria-hidden="true"></i></button>
							</div>
							<div class="play_text">
								<p class="name_sound">Название песни</p>
								<p class="name_album">Исполнитель - альбом</p>
							</div>
						</li>
						<li class="play_li">
							<div class="butt_wrap">
								<button class="button_play red"><i class="fa fa-play" aria-hidden="true"></i></button>
								<button class="button_play orange"><i class="fa fa-play" aria-hidden="true"></i></button>
							</div>
							<div class="play_text">
								<p class="name_sound">Название песни</p>
								<p class="name_album">Исполнитель - альбом</p>
							</div>
						</li>
						<li class="play_li">
							<div class="butt_wrap">
								<button class="button_play red"><i class="fa fa-play" aria-hidden="true"></i></button>
								<button class="button_play orange"><i class="fa fa-play" aria-hidden="true"></i></button>
							</div>
							<div class="play_text">
								<p class="name_sound">Название песни</p>
								<p class="name_album">Исполнитель - альбом</p>
							</div>
						</li>
						<li class="play_li">
							<div class="butt_wrap">
								<button class="button_play red"><i class="fa fa-play" aria-hidden="true"></i></button>
								<button class="button_play orange"><i class="fa fa-play" aria-hidden="true"></i></button>
							</div>
							<div class="play_text">
								<p class="name_sound">Название песни песни песни песни</p>
								<p class="name_album">Исполнитель - альбом</p>
							</div>
						</li>
						<li class="play_li">
							<div class="butt_wrap">
								<button class="button_play red"><i class="fa fa-play" aria-hidden="true"></i></button>
								<button class="button_play orange"><i class="fa fa-play" aria-hidden="true"></i></button>
							</div>
							<div class="play_text">
								<p class="name_sound">Название песни</p>
								<p class="name_album">Исполнитель - альбом альбом альбом альбом альбом</p>
							</div>
						</li>
						<li class="play_li">
							<div class="butt_wrap">
								<button class="button_play red"><i class="fa fa-play" aria-hidden="true"></i></button>
								<button class="button_play orange"><i class="fa fa-play" aria-hidden="true"></i></button>
							</div>
							<div class="play_text">
								<p class="name_sound">Название песни</p>
								<p class="name_album">Исполнитель - альбом</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- playlist_left -->





			<div class="playlist_right">
				<p class="playlist_name">Дополнительные опции</p>

				<div class="playlist">
					<ul>
						<li class="play_li active">
							<span class="num">1.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">2.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">3.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">4.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">5.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">6.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">7.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">8.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">9.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">10.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>


						<li class="play_li">
							<span class="num">10.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">11.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">12.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">13.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">14.</span>
							<div>
								<p class="name_sound">Название опции опции опции опции опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">15.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация информация информация информация информация информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">16.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>
						<li class="play_li">
							<span class="num">17.</span>
							<div>
								<p class="name_sound">Название опции</p>
								<p class="name_album">Дополнительная информация</p>
							</div>
						</li>


					</ul>
				</div>
			</div>
			<!-- playlist_right -->

		</div>
		<!-- mixer_playlist -->




	</div>
</section>
<!-- mixer_section -->

<!-- /секция с микшером -->



<?/*?>
<section class="mixer" style="height: 600px">
	<div class="contein">	
		<div class="user_info">
			<div class="img" style="background-image: url(<?=$user->image;?>);"></div>
			<p class="name"><?=$user->fullName;?></p>
			<?=Html::beginForm(['/site/logout'], 'post')
	            . Html::submitButton(
	                'Выйти  <i class="fa fa-sign-out" aria-hidden="true"></i>',
	                ['class' => 'exit']
	            )
	            . Html::endForm();
            ?>
		</div>
	</div>
</section>
<?*/?>



<!-- 
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="my_tracks pt_small pb_big">
	<div class="contain">
		<div class="section_top">
			<h3 class="section_name">Мои треки</h3>
			<p class="section_anons">треки текущего этапа</p>
		</div>

		<?php if($userStagePosts):?>
			<div class="wrap_tracks_slider">
				<div class="tracks_slider owl-carousel sl_1">
					<?php foreach ($userStagePosts as $key => $post):?>
						<?=$this->render('_post', ['post' => $post]);?>
					<?php endforeach;?>
				</div>
				<!-- tracks_slider -->
				<div class="slider_nav sl_nav_1"></div>
				<div class="slider_dots sl_dots_1"></div>
			</div>
			<!-- wrap_tracks_slider -->
		<?php endif;?>



		<?php if($userOldPosts):?>
			<p class="show_archive">
				<span>Архив<i class="fa fa-caret-up" aria-hidden="true"></i></span>
			</p>

			<div class="archive_hide">
				<div class="wrap_tracks_slider">
					<div class="tracks_slider owl-carousel sl_1">
						<?php foreach ($userOldPosts as $key => $post):?>
							<?=$this->render('_post', ['post' => $post]);?>
						<?php endforeach;?>
					</div>
					<!-- tracks_slider -->
					<div class="slider_nav sl_nav_2"></div>
					<div class="slider_dots sl_dots_2"></div>
				</div>
				<!-- wrap_tracks_slider -->
			</div>
			<!-- archive_hide -->
		<?php endif;?>
	</div>
</section>
<!-- my_tracks -->




<section class="voting pt_big pb_big">
	<div class="contain">
		<div class="section_top">
			<h3 class="section_name">Голосуй за треки других участников</h3>
		</div>
			<?php if($otherPosts):?>
			<div class="wrap_tracks_slider">
				<div class="tracks_slider owl-carousel sl_1">
					<?php foreach ($otherPosts as $key => $post):?>
						<?=$this->render('@frontend/views/site/_post', ['post' => $post]);?>
					<?php endforeach;?>
				</div>
				<!-- tracks_slider -->
				<div class="slider_nav sl_nav_3"></div>
				<div class="slider_dots sl_dots_3"></div>
			</div>
			<!-- wrap_tracks_slider -->
		<?php endif;?>
	</div>
</section>
<!-- voting -->