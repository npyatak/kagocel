<?php
use yii\helpers\Url;
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


<section class="conditions_section pt_big pb_big">
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


<section class="video_section pt_big pb_big">
	<div class="contain">

		<div class="section_top">
			<h3 class="section_name">Когда тв<i>о</i>я девушка больна</h3>
			<p class="section_desc">Вдохновляйся этим роликом и создавай свой трек для любимых!</p>
		</div>

		<div class="video_player_wrap">
			<iframe id="video_player" width="720" height="405" src="//rutube.ru/play/embed/11982280?quality=1&platform=someplatform" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>

			
	</div>
</section>
<!-- video_section -->




<section class="mixer_main pt_big pb_big">
	<div class="contain">
		<div class="section_top">
			<h3 class="section_name">Создай св<i>о</i>й микс</h3>
			<a href="<?=Url::toRoute(['site/faq']);?>" target="_blank" class="regulations_button" data-ga-click="click_button_how_to_make">Как сделать свой трек</a>
		</div>

		<?=$this->render('@frontend/views/personal/_mixer');?>

		<?=$this->render('@frontend/views/personal/_playlist');?>
	</div>
</section>




<section class="you_prize dark_bg bottom pt_big pb_big">
	<div class="contain">

		<div class="section_top">
			<h3 class="section_name">Тв<i>о</i>и призы</h3>
		</div>


		
		<div class="prize_top">
			<img class="tickets" src="img/tickets.png" alt="img">
			<img class="sticker" src="img/sticker.png" alt="img">
		</div>

		<div class="offers_wrap">
			<div class="offers_item one" style="background-image: url(img/offer_1.png)">
				<div>Дождевик</div>
			</div>
			<div class="offers_item two" style="background-image: url(img/offer_2.png)">
				<img class="sticker_2" src="img/sticker_2.png" alt="img">
				<div>дождевики на обувь</div>
			</div>
			<div class="offers_item three" style="background-image: url(img/offer_3.png)">
				<div>свитшот</div>
			</div>
		</div>

	</div>
	<!-- contain -->
</section>
<!-- you_prize -->


<div class="popup_bg">
        
    <div class="popup_block style_1" data-flag="1">
        <div class="popup_decor">
            <span class="top"></span>
            <span class="bottom"></span>
        </div>
        <img class="exit_popup" src="/img/close_middle.svg" alt="close">
        <p class="popup_text">Пожалуйста, для начала выберите трек из списка снизу</p>
        <div class="center">
            <button class="button_1 point close_popup"><span>хорошо</span></button>
        </div>      
    </div>
    <!-- popup_block -->

    <div class="popup_block style_1" data-flag="2">
        <div class="popup_decor">
            <span class="top"></span>
            <span class="bottom"></span>
        </div>
        <img class="exit_popup" src="/img/close_middle.svg" alt="close">
        <p class="popup_text">Пожалуйста, сначала выберите оба трека в списке снизу.</p>
        <div class="center">
            <button class="button_1 point close_popup"><span>хорошо</span></button>
        </div>      
    </div>
    <!-- popup_block -->

    <div class="popup_block style_1 wide" data-flag="3">
        <div class="popup_decor">
            <span class="top"></span>
            <span class="bottom"></span>
        </div>
        <img class="exit_popup" src="/img/close_middle.svg" alt="close">
        <p class="section_name">Данные успешно обн<i>о</i>влены</p>
        <div class="center">
            <p class="popup_text">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют</p>
            <button class="button_1 point close_popup"><span>хорошо</span></button>
        </div>      
    </div>
    <!-- popup_block -->
        
</div>
<!-- popup_bg -->