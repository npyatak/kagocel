<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'name' => 'kagocel',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '/',
            'csrfParam' => '_csrf-frontend',
        ],
        'assetManager' => [
            'bundles' => [
                // 'yii\web\JqueryAsset' => [
                //     //'js' => ['/libs/jquery/jquery.min.js'],
                //     'js' => ['/js/jquery-3.2.1.min.js'],
                // ],
                // 'yii\bootstrap\BootstrapAsset' => [
                //     'js' => ['/js/bootstrap.min.js'],
                //     'css' => ['/css/bootstrap.min.css']
                // ],
            ]
        ],
        'user' => [
            //'class' => 'frontend\components\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => require(__DIR__ . '/services.php'),
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LfgnHgUAAAAAIsnIsB_UzpLajybv8DDtk8ocPOL',
            'secret' => '6LfgnHgUAAAAADD0zgr9Ot0EfDst__9kwbPuLHzE',
        ],
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
            'rules' => [
                '/' => 'site/index',
                '<controller:game|personal>'=>'<controller>/index',
                '<controller:game|personal>/<action>'=>'<controller>/<action>',
                '<controller:game|personal>/<action>/<id:\d+>' => '<controller>/<action>',
                '<action>/<id:\d+>' => 'site/<action>',
                '<action>' => 'site/<action>',
            ],
        ],
    ],
    'params' => $params,
];
