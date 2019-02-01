<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Авторизация';
?>

<section class="authorization after_header">
	<div class="contain">
		<div class="authorization_step_1">
			<h2 class="section_title red_letter" data-letter="4">Авт<i>о</i>ризация<img src="img/arrow_orange.svg" alt="img"></h2>
			<p class="autorization_anons">
				Для участия в конкурсе необходимо авторизоваться на нашем сайте через одну из твоих социальных сетей
			</p>

			<div class="authorization_soc">
				<?=\frontend\widgets\social\SocialWidget::widget();?>
			</div>
		</div>
	</div>
</section>