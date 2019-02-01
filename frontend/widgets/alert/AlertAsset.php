<?php

namespace frontend\widgets\alert;

use yii\web\AssetBundle;

class AlertAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/pnotify.custom.min.css',
    ];
    public $js = [
        'js/pnotify.custom.min.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
