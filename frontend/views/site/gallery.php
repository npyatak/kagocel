<!-- 
gradient_bg - задает градиент блоку
pt_small - малый отступ сверху
pb_big - большой отступ снизу
after_header - говорит о том, что этот блок идет после header, что-бы скрипт задал ему отступ сверху
 -->
<section class="section_main gradient_bg after_header">
	<div class="decorate_letter">
		<img src="/img/letter_o.png" alt="img">
	</div>

	<div class="contain pt_small">
		

		<div class="main_wrap_blocks and_button">
			<div class="wrap_big_img"><img class="big_img" src="/img/packt.png" alt="img"></div>
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

<section class="section_gallery pb_small">
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

<?php if(!empty($finishedStages)):?>
	<section class="section_hide_show gradient_bg">
		<div class="all_show_button">
			показать еще <i class="fa fa-caret-up aria-hidden="true"></i>
		</div>
		<!-- all_show -->

		<div class="all_show_block pb_small">
			<div class="contain">
				<?php foreach ($finishedStages as $s):?>
					<?php if(!empty($winnersPosts[$s->id])):?>
						<h3 class="section_name show"><span>п<i>о</i>бедители второго этапа  <i class="fa fa-caret-up" aria-hidden="true"></i></span></h3>

						<div class="stage_show">
							<div>
								<?php foreach ($winnersPosts[$s->id] as $key => $post):?>
									<?=$this->render('_post', ['post' => $post]);?>
								<?php endforeach;?>
							</div>
						</div>
						<!-- stage_show -->
					<?php endif;?>
				<?php endforeach;?>
			</div>
		</div>
	</section>
<?php endif;?>