<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class MixerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
		'js/AudioContextMonkeyPatch.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}