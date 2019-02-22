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
        'css/libs.min.css',
        'css/main.css',
    ];
    public $js = [
        'js/libs.min.js',
        'js/common.js',
        'js/audio-recorder-polyfill.js',
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
