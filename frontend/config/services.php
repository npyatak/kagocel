<?php 
return [
    'fb' => [
        // register your app here: https://developers.facebook.com/apps/
        'class' => 'frontend\models\social\FbOAuth2Service',
        'clientId' => '506014906472268',
        'clientSecret' => '3bcf4d406d396a10ec82332fc26a596e',
        'title' => 'Facebook',
    ],
    'vk' => [
        // register your app here: https://vk.com/editapp?act=create&site=1
        'class' => 'frontend\models\social\VkOAuth2Service',
        'clientId' => '6831961',
        'clientSecret' => '5GT6lPT6ic3YPknXB3p4',
        'title' => 'Вконтакте',
    ],
    'ok' => [
        // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
        // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
        'class' => 'frontend\models\social\OkOAuth2Service',
        'clientId' => '1275412992',
        'clientPublic' => 'CBADEGANEBABABABA',
        'clientSecret' => '7B4384B41E808C5C50C8FDDF',
        'title' => 'Одноклассники',
    ],
    /*'tw' => [
        // register your app here: https://dev.twitter.com/apps/new
        'class' => 'frontend\models\social\TwOAuth1Service',
        'key' => 'UNhs5odAQ76iVUgtIXdQmQ',
        'secret' => 'vBDUPmOTAikctBoppPZEOpwTCNpnxG7I4CFHmnrFI',
        'title' => 'Twitter',
    ],
    'gp' => [
        // register your app here: https://code.google.com/apis/console/
        'class' => 'frontend\models\social\GpOAuth2Service',
        'clientId' => '104753729855.apps.googleusercontent.com',
        'clientSecret' => '5aYmCbAUpZnO-UVXzo5O-8bW',
        'title' => 'Google Plus',
    ],*/
];