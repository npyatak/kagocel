<section class="faq dark_bg bottom after_header min_h">
	<div class="contain pt_small pb_big">
		
		<div class="section_top">
			<h3 class="section_name">Faq</h3>
			<p class="section_anons">Часто задаваемые вопросы</p>
		</div>

		<div class="questions_wrap">
			<?php foreach ($faq as $f):?>
				<div class="question">
					<p class="name"><?=$f->title;?></p>
					<div class="text">
						<p class="grey"><?=$f->text;?></p>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<!-- question_wrap -->
	</div>
</section>