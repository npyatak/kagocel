<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<?/*
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
*/?>


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
				

				<div class="main_wrap_blocks two_packt and_button">
					<div class="wrap_big_img"><img class="big_img" src="img/packt.png" alt="img"></div>

					<div class="wrap_big_img"><img class="big_img" src="img/packt2.png" alt="img"></div>

				</div>

			</div>
		</section>
		<!-- section_main -->


		<section class="about_product pb_big">
			<div class="contain">

				<div class="section_top">
					<h3 class="section_name">выб<i>о</i>р специалистов</h3>
					<p class="section_desc">Кагоцел - противовирусное средство широкого спектра действия, которое применяется для профилактики и лечения простуды и гриппа у взрослых и детей с 3-х лет.</p>
				</div>
				<a href="#" class="button_bg black_gray"><span>Подробнее о продукте</span></a>
			</div>
		</section>







