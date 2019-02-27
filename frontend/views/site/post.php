<?php
use yii\helpers\Url;
?>

<?=\frontend\widgets\share\ShareWidget::widget(['post' => $post, 'showButtons' => false]);?>

<section class="section_main dark_bg pb_big after_header">
	<div class="contain">

		<div class="main_wrap_blocks and_button ">
			<div class="wrap_big_img"><img class="big_img" src="/img/packt.png" alt="img"></div>
			<div class="main_right">
				<p class="main_name">
					Прокачай свою заботу с каг<i>о</i>целом
					<img src="/img/big_arrow.svg" alt="img">
				</p>
				<p class="anons">
					Создай свой уникальный музыкальный трек и получи шанс выиграть крутые призы! 
				</p>
				<a href="<?=Url::toRoute(['personal/index']);?>" class="button_1 point" data-ga-click="click_button_participate"><span>Участвовать</span></a>
			</div>
		</div>

	</div>
	<p class="sixteen_item"><img src="/img/sixteen.svg" alt="16+"></p>
</section>
<!-- section_main -->

<section class="section_gallery pb_small pt_big">
	<div class="contain">
		<div class="gallery_main">
			<?=$this->render('_post', ['post' => $post]);?>
		</div>
	</div>
</section>

<section class="section_gallery pb_small pt_big">
	<div class="contain">
		
		<div class="section_top">
			<h3 class="section_name"><?=strtolower($stage->name);?></h3>
			<p class="section_date"><span><?=$stage->startDate;?></span> <span><?=$stage->endDate;?></span></p>
		</div>

		<div class="gallery_main">
			<?php foreach ($stagePosts as $key => $p):?>
				<?=$this->render('_post', ['post' => $p]);?>
			<?php endforeach;?>
		</div>
	</div>
</section>