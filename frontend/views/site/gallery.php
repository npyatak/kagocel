<?php
use yii\helpers\Url;

$arr = [
	1 => 'первого',
	2 => 'второго',
	3 => 'третьего',
	4 => 'четвертого',
	5 => 'пятого',
	6 => 'шестого',
];
?>
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

<?php if(!empty($finishedStages)):?>
	<section class="section_hide_show dark_bg bottom">
		<!-- <div class="all_show_button">
			показать еще <i class="fa fa-caret-up" aria-hidden="true"></i>
		</div> -->
		<!-- all_show -->

		<div class="all_show_block pb_small">
			<div class="contain">
				<?php if($finalWinnerPost):?>
					<h3 class="section_name show"><span>Финалист</span></h3>

					<div class="stage_show">
						<div>
							<?=$this->render('_post', ['post' => $finalWinnerPost]);?>
						</div>
					</div>
				<?php endif;?>
				
				<?php foreach ($finishedStages as $s):?>
					<?php if(!empty($s->winnerPosts)):?>
						<h3 class="section_name show"><span>победители <?=$arr[$s->number];?> этапа  <i class="fa fa-caret-up" aria-hidden="true"></i></span></h3>

						<div class="stage_show">
							<div>
								<?php foreach ($s->winnerPosts as $key => $post):?>
									<?=$this->render('_post', ['post' => $post]);?>
								<?php endforeach;?>
							</div>
						</div>
					<?php endif;?>
				<?php endforeach;?>
			</div>
		</div>
	</section>
<?php endif;?>

<?php if($stage):?>
	<section class="section_gallery pb_small pt_big">
		<div class="contain">
			
			<div class="section_top">
				<h3 class="section_name"><?=strtolower($stage->name);?></h3>
				<p class="section_date"><span><?=$stage->startDate;?></span> <span><?=$stage->endDate;?></span></p>
			</div>

			<div class="gallery_main">
				<?php foreach ($stagePosts as $key => $post):?>
					<?=$this->render('_post', ['post' => $post]);?>
				<?php endforeach;?>
			</div>
		</div>
	</section>
<?php endif;?>

<?php if(!empty($finishedStages)):?>
	<section class="section_hide_show dark_bg bottom">
		<div class="all_show_block pb_small">
			<div class="contain">
				<?php foreach ($finishedStages as $s):?>
					<?php if(!empty($s->posts)):?>
						<h3 class="section_name show"><span>участники <?=$arr[$s->number];?> этапа  <i class="fa fa-caret-up" aria-hidden="true"></i></span></h3>

						<div class="stage_show">
							<div>
								<?php foreach ($s->posts as $key => $post):?>
									<?=$this->render('_post', ['post' => $post]);?>
								<?php endforeach;?>
							</div>
						</div>
					<?php endif;?>
				<?php endforeach;?>
			</div>
		</div>
	</section>
<?php endif;?>