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
					Прокачай свою заботу с кагоцел<i>о</i>м
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

		<div class="section_top">
			<h3 class="section_name">Создай св<i>о</i>й микс</h3>
			<a href="#" class="regulations_button">Правила пользования dj микшером</a>
		</div>

		<?=$this->render('_mixer');?>

		<?=$this->render('_playlist');?>
	</div>
</section>
<!-- mixer_section -->

<!-- /секция с микшером -->

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