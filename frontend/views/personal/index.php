<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<!-- 
bg_1 - определяет фон блока и цвет шрифта внутри
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="section_main bg_1 after_header">
	<div class="contain pt_small">
		

		<div class="main_wrap_blocks">
			<img class="big_img" src="/img/packt.png" alt="img">
			<div class="main_right">
				<p class="main_name">
					Прокачай свою заботу с каг<i>о</i>цел
					<img src="/img/arrow_orange.svg" alt="img">
				</p>
				<p class="anons">
					Создай свой уникальный музыкальный трек и получи шанс выиграть крутые призы! 
				</p>
			</div>
		</div>

	</div>
</section>
<!-- section_main -->

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

<!-- 
bg_1 - определяет фон блока и цвет шрифта внутри
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="my_tracks bg_1 pt_small pb_big">
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