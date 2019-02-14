<?php
use yii\helpers\Url;
?>

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
				<a href="<?=Url::toRoute(['personal/index']);?>" class="button_bg black_gray"><span>Участвовать</span></a>
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
			<a href="#" class="regulations_button">Как сделать свой трек</a>
		</div>

		<?=$this->render('@frontend/views/personal/_mixer');?>
	</div>
</section>

<section class="you_prize gradient_bg pt_big pb_small">
	<div class="contain">

		<div class="section_top">
			<h3 class="section_name">Тв<i>о</i>и призы</h3>
			<p class="section_desc">май 2019</p>
		</div>
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