<?php
// $melodies = [
// 	['id' => 1, 'url' => '/audio/TheUnderworld.ogg', 'name' => 'TheUnderworld', 'album' => ''],
// 	['id' => 2, 'url' => '/audio/RapidArc.ogg', 'name' => 'RapidArc'],
// 	['id' => 3, 'url' => '/audio/EddyHerrera-LaFajita.mp3', 'name' => 'LaFajita', 'album' => 'EddyHerrera'],
// 	['id' => 4, 'url' => '/audio/CopperMountain.ogg', 'name' => 'CopperMountain'],
// ];

$melodies = [
	['id' => 0, 'url' => '/audio/kino.mp3', 'name' => 'Когда твоя девушка больна', 'author' => 'Кино', 'bpm' => 140],
	['id' => 1, 'url' => '/audio/splean.mp3', 'name' => 'Дочь самурая', 'author' => 'Сплин', 'bpm' => 140]
];

$sounds = scandir(__DIR__.'/../../web/sounds');
?>

<div class="mixer_playlist pb_big">
	<div class="playlist_left">
		<p class="playlist_name">Выбор песен</p>

		<div class="playlist">
			<ul>
				<?php foreach ($melodies as $m):?>
					<li class="play_li sound mixer__select-music-container" data-sound_url="<?=$m['url'];?>" data-bpm="<?=$m['bpm'];?>" data-id="<?=$m['id'];?>">
						<div class="butt_wrap">
							<button class="button_play red trackLeft mixer__select-music-first"><i class="fa fa-play" aria-hidden="true"></i></button>
							<button class="button_play orange trackRight mixer__select-music-second"><i class="fa fa-play" aria-hidden="true"></i></button>
						</div>
						<div class="play_text">
							<p class="name_sound mixer__select-music-name"><?=$m['name'];?></p>
							<p class="name_album mixer__select-music-author"><?=$m['author'];?></p>
							<?php if(isset($m['album'])):?>
								<p class="name_album"><?=$m['album'];?></p>
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
				<?php foreach ($sounds as $key => $sound):?>
					<?php if(!in_array($sound, [".",".."])):?>
						<li class="play_li active" data-url="/sounds/<?=$sound;?>" data-id="<?=$key + 1;?>">
							<span class="num"><?=$key + 1;?>.</span>
							<div>
								<p class="name_sound"><?=$sound;?></p>
							</div>
						</li>
					<?php endif;?>
					<?php if($key >= 30) break;?>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<!-- playlist_right -->

</div>
<!-- mixer_playlist -->