<?php
use yii\helpers\Url;
?>

<section class="mixer_section">
	<div class="contain">
		<div class="section_top">
			<h3 class="section_name">Создай новый трек</h3>
			<a href="<?=Url::toRoute(['site/faq']);?>" class="regulations_button">Правила пользования dj микшером</a>
		</div>

		<?=$this->render('_mixer');?>

		<?=$this->render('_playlist');?>
	</div>
</section>
<!-- mixer_section -->