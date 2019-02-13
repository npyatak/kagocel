<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class MixerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
		'http://cwilso.github.io/AudioContext-MonkeyPatch/AudioContextMonkeyPatch.js',
		'mixer/js/WebMIDIAPI.js',
		//'mixer/js/cue.js',
		//'mixer/js/dj.js',
		//'mixer/js/midi.js',
		//'mixer/js/tracks.js',
		//'mixer/js/visualizer.js',
        //'mixer/js/audiodisplay.js',
        'js/track.js',
		'js/controls.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}