<?php
$soundItems = [
	['id' => 1, 'url' => '/audio/TheUnderworld.ogg', 'name' => 'TheUnderworld', 'album' => ''],
	['id' => 2, 'url' => '/audio/RapidArc.ogg', 'name' => 'RapidArc'],
	['id' => 3, 'url' => '/audio/EddyHerrera-LaFajita.mp3', 'name' => 'LaFajita', 'album' => 'EddyHerrera'],
	['id' => 4, 'url' => '/audio/CopperMountain.ogg', 'name' => 'CopperMountain'],
];
?>

<div class="mixer_playlist pb_big">
	<div class="playlist_left">
		<p class="playlist_name">Выбор песен</p>

		<div class="playlist">
			<ul>
				<?php foreach ($soundItems as $sound):?>
					<li class="play_li sound" data-url="<?=$sound['url'];?>" data-id="<?=$sound['id'];?>">
						<div class="butt_wrap">
							<button class="button_play red trackLeft"><i class="fa fa-play" aria-hidden="true"></i></button>
							<button class="button_play orange trackRight"><i class="fa fa-play" aria-hidden="true"></i></button>
						</div>
						<div class="play_text">
							<p class="name_sound"><?=$sound['name'];?></p>
							<?php if(isset($sound['album'])):?>
								<p class="name_album"><?=$sound['album'];?></p>
							<?php endif;?>
						</div>
					</li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<!-- playlist_left -->





	<div class="playlist_right">
		<p class="playlist_name">Дополнительные опции</p>

		<div class="playlist">
			<ul>
				<li class="play_li active">
					<span class="num">1.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">2.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">3.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">4.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">5.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">6.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">7.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">8.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">9.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">10.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>


				<li class="play_li">
					<span class="num">10.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">11.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">12.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">13.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">14.</span>
					<div>
						<p class="name_sound">Название опции опции опции опции опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">15.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация информация информация информация информация информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">16.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>
				<li class="play_li">
					<span class="num">17.</span>
					<div>
						<p class="name_sound">Название опции</p>
						<p class="name_album">Дополнительная информация</p>
					</div>
				</li>


			</ul>
		</div>
	</div>
	<!-- playlist_right -->

</div>
<!-- mixer_playlist -->