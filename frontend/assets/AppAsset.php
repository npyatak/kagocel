<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/libs.min.css?v=1',
        'css/main.css?v=1',
    ];
    public $js = [
        'js/libs.min.js?v=1',
        'js/common.js?v=1',
        'js/buff-audio.js',
        'https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.4.0/wavesurfer.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
        'https://cdn.webrtc-experiment.com/MultiStreamsMixer.js',
        'js/main.js',
        'js/music-mixer.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
