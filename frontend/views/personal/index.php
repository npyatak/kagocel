<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<section class="section_main lk dark_bg after_header">

	<div class="contain">

		<div class="main_wrap_blocks and_button ">
			<div class="wrap_big_img"><img class="big_img" src="/img/packt.png" alt="img"></div>
			<div class="main_right">
				<p class="main_name">
					Прокачай свою заботу с каг<i>о</i>целом
					<img src="/img/big_arrow.svg" alt="img">
				</p>
				<p class="anons">
					Создай свой уникальный музыкальный трек и получи шанс выиграть <a href="/#you_prize">крутые призы!</a>
				</p>
				
			</div>
		</div>

	</div>
	<p class="sixteen_item"><img src="/img/sixteen.svg" alt="16+"></p>
</section>

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
			<a href="<?=Url::toRoute(['site/faq']);?>"" target="_blank" class="regulations_button" data-ga-click="click_button_how_to_make">Как сделать свой трек</a>
		</div>

		<?=$this->render('_mixer');?>

		<?=$this->render('_playlist');?>
	</div>
</section>

<section class="my_tracks dark_bg pt_big pb_big">
	<div class="contain">
		<div class="section_top">
			<h3 class="section_name">М<i>о</i>и треки</h3>
			<p class="section_anons">треки текущего этапа</p>
		</div>
	
		<?php $count = 1;?>
		<?php if($userStagePosts):?>	
			<div class="wrap_tracks_slider">
				<div class="tracks_slider owl-carousel sl_1">
					<?php foreach ($userStagePosts as $key => $post):?>
						<?=$this->render('_post', ['post' => $post]);?>
					<?php endforeach;?>
				</div>
				<div class="slider_nav sl_nav_<?=$count?>"></div>
				<div class="slider_dots sl_dots_<?=$count?>"></div>
			</div>
			<?php $count++;?>
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
					<div class="slider_nav sl_nav_<?=$count?>"></div>
					<div class="slider_dots sl_dots_<?=$count?>"></div>
				</div>
				<!-- wrap_tracks_slider -->
			</div>
			<?php $count++;?>
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
				<div class="slider_nav sl_nav_<?=$count?>"></div>
				<div class="slider_dots sl_dots_<?=$count?>"></div>
			</div>
		<?php endif;?>
	</div>
</section>
<!-- voting -->