<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class MixerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
		'js/AudioContextMonkeyPatch.js',
		'mixer/js/WebMIDIAPI.js',
        'js/track.js',
		'js/controls.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}