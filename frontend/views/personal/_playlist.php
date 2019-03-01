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

$sounds = [
	['url' => '/audio/additional_tracks/voice_2.mp3', 'name' => 'Voice 2'],
	['url' => '/audio/additional_tracks/voice_3.mp3', 'name' => 'Voice 3'],
	['url' => '/audio/additional_tracks/voice_4.mp3', 'name' => 'Voice 4'],
	['url' => '/audio/additional_tracks/voice_5.mp3', 'name' => 'Voice 5'],
	['url' => '/audio/additional_tracks/voice_6.mp3', 'name' => 'Voice 6'],
	['url' => '/audio/additional_tracks/voice_7.mp3', 'name' => 'Voice 7'],
]
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
				<?php foreach ($sounds as $key => $s):?>
						<li class="play_li mixer__additional-track-player" data-url="<?=$s['url'];?>" data-id="<?= $s['name'] ?>">
							<span class="num"><?=$key + 1;?>.</span>
							<div>
								<p class="name_sound"><?=$s['name'];?></p>
							</div>
						</li>
					<?php if($key >= 30) break;?>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<!-- playlist_right -->

</div>
<!-- mixer_playlist -->