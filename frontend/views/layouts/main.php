<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\alert\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="16x16" href="//cdn.tnt-online.ru/tnt2012/favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="32x32" href="//cdn.tnt-online.ru/tnt2012/favicon-32x32.png" />
    <link rel="apple-touch-icon" sizes="96x96" href="//cdn.tnt-online.ru/tnt2012/favicon-96x96.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="//cdn.tnt-online.ru/tnt2012/tnt-114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="//cdn.tnt-online.ru/tnt2012/tnt-144.png" />    
    <link rel="shortcut icon" type="image/icon" href="/favicon.ico">

    <link rel="stylesheet" type="text/css" href="//cdn.tnt-online.ru/cookie/accept_cookie.css" title="application/x-javascript" />
    <script type="application/x-javascript" src="//cdn.tnt-online.ru/cookie/accept_cookie.js"></script>
    <!-- <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png"> -->

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <!-- <meta name="msapplication-navbutton-color" content="#000"> -->
    <!-- iOS Safari -->
    <!-- <meta name="apple-mobile-web-app-status-bar-style" content="#000"> -->

    <meta name="description" content="Собери свой трек и выиграй призы">
    <meta name="yandex-verification" content="" />

    <?= Html::csrfMetaTags() ?>
    <title>kagocel <?=$this->title ? ' - '.Html::encode($this->title) : '';?></title>

    <?php // if($_SERVER['HTTP_HOST'] != 'kagocel.local'):?>
        <script type="text/javascript">
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-2865583-8', 'auto');
            ga('send', 'pageview',{'page': "<?=Url::current();?>"});
              
            // Yandex.Metrika counter 

            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter32937699 = new Ya.Metrika({
                            id:32937699,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true
                        });
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");

            // TNS Counter
            var img = new Image();
            img.src = '//www.tns-counter.ru/V13a***R>' + document.referrer.replace(/\*/g,'%2a') + '*tnt_ru/ru/CP1251/tmsec=tnt_online/';

            // Cookies agreement
            window.onload = function() {
                if(!document.getElementsByClassName('gpm-cookie-accepted').length) {
                    var GPM_AcceptCookie = new GPMAcceptCookie('tnt-online.ru');
                    GPM_AcceptCookie.googleAnalytics(ga);
                    GPM_AcceptCookie.check();
                }
            };
            </script>
            <noscript><img src="//www.tns-counter.ru/V13a****tnt_ru/ru/CP1251/tmsec=tnt_online/" width="1" height="1" alt="" /></noscript>
            <noscript><div><img src="https://mc.yandex.ru/watch/32937699" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <?php //endif;?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">

    
        <?php $menuItems = [
            ['label' => 'Главная', 'c' => 'site', 'a' => 'index', 'data-ga-click' => 'click_main_page'],
            ['label' => 'Личный кабинет', 'c' => 'personal', 'a' => 'index', 'data-ga-click' => 'click_personal_page'],
            ['label' => 'Галерея', 'c' => 'site', 'a' => 'gallery', 'data-ga-click' => 'click_gallery_page'],
            ['label' => 'О продукте', 'c' => 'site', 'a' => 'about', 'data-ga-click' => 'click_about_page'],
            ['label' => 'Обратная связь', 'c' => 'site', 'a' => 'contact'],
            ['label' => 'Faq', 'c' => 'site', 'a' => 'faq', 'data-ga-click' => 'click_faq_page'],
            ['label' => 'Правила', 'c' => 'site', 'a' => 'rules', 'target' => '_blank', 'data-ga-click' => 'click_rules_page'],
        ];?>


        <header class="header_main">
            <div class="contain">
                <div class="burger_button">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>

                <a class="logo_1" href="https://www.kagocel.ru/" target="_blank" data-ga-click="click_kagocel_logo">
                    <img src="/img/logo_1_2.svg" alt="logo">
                </a>
                <nav class="main_menu">
                    <ul>
                        <?php foreach ($menuItems as $item):?>
                            <?php $active = Yii::$app->controller->id == $item['c'] && Yii::$app->controller->action->id == $item['a'];?>
                            <li><a href="<?=Url::toRoute($item['c'].'/'.$item['a']);?>" 
                                    <?=isset($item['target']) ? 'target='.$item['target'] : '';?> 
                                    <?=isset($item['data-ga-click']) ? 'data-ga-click="'.$item['data-ga-click'].'"' : '';?>
                                    <?=$active ? 'class="active"' : '';?>
                                    >
                                        <?=$item['label'];?>
                                </a>
                            </li>
                        <?php endforeach;?>
                </nav>
                <a class="logo_2" href="http://studia-soyuz.tnt-online.ru/" target="_blank" data-ga-click="click_soyuz_logo">
                    <img src="/img/logo_2.png" alt="logo">
                </a>
            </div>
        </header>

        <div class="burger_menu dark_bg">
            <div class="contain">
                <img class="close_burger" src="img/close_middle.svg" alt="close">
                <ul class="burger_ul">
                    <?php foreach ($menuItems as $item):?>
                        <?php $active = Yii::$app->controller->id == $item['c'] && Yii::$app->controller->action->id == $item['a'];?>
                            <li><a href="<?=Url::toRoute($item['c'].'/'.$item['a']);?>" 
                                <?=isset($item['target']) ? 'target='.$item['target'] : '';?> 
                                <?=isset($item['data-ga-click']) ? 'data-ga-click="'.$item['data-ga-click'].'"' : '';?>
                                <?=$active ? 'class="active"' : '';?>
                                >
                                    <?=$item['label'];?>
                                </a>
                            </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>

        <?= $content ?>

        <footer class="main_footer">
            <div class="footer_top">
                <div class="contain">
                    <div>
                        <div class="logo_block">

                            <a class="footer_logo" href="https://www.kagocel.ru/" target="_blank" data-ga-click="click_kagocel_logo"><img src="/img/logo_1_2.svg" alt="logo"></a>
                            <a class="footer_logo" href="http://studia-soyuz.tnt-online.ru/" target="_blank" data-ga-click="click_soyuz_logo"><img src="/img/logo_2.png" alt="logo"></a>
                        </div>

                        <nav class="footer_menu">
                            <ul>
                                <?php foreach ($menuItems as $item):?>
                                    <?php $active = Yii::$app->controller->id == $item['c'] && Yii::$app->controller->action->id == $item['a'];?>
                                    <li><a href="<?=Url::toRoute($item['c'].'/'.$item['a']);?>" 
                                        <?=isset($item['target']) ? 'target='.$item['target'] : '';?>
                                        <?=isset($item['data-ga-click']) ? 'data-ga-click="'.$item['data-ga-click'].'"' : '';?> 
                                        <?=$active ? 'class="active"' : '';?>
                                        >
                                            <?=$item['label'];?>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </nav>

                        <div class="footer_text_block">
                           <div class="text">
                               <p>
                                   Общий период конкурса, включая выдачу призов: с 04 марта по 31 мая 2019 года. Период приёма конкурсных работ с 4 марта по 31 марта 2019 года. Подробности об организаторе конкурса, правилах его проведения, количестве подарков по его результатам, сроках, месте и порядке их получения смотри <a href="/rules" target="_blanck">тут</a>.
                               </p>
                               <p>
                                   внешний вид призов может отличаться от изображенияв рекламных материалах
                               </p>
                           </div> 
                       
                           <p class="copyright">© Copyright 2019 ОАО «ТНТ-телесеть». Все права защищены</p>
                       </div>
                    </div>

                    <p class="sixteen_item"><img src="/img/sixteen.svg" alt="16+"></p>

                </div>
            </div>
            <!-- footer_top -->

            <div class="footer_bottom">
                <p>Имеются противопоказания. необходимо ознакомиться <br>с инструкцией или проконсультироваться со специалистом</p>
            </div>
        </footer>
    </div>

    <div class="popup_bg">
        <div class="popup_block style_1 wide">
            <div class="popup_decor">
                <span class="top"></span>
                <span class="bottom"></span>
            </div>
            <img class="exit_popup" src="/img/close_middle.svg" alt="close">
            <p class="section_name"></p>
            <div class="center">
                <p class="popup_text"></p>
                <button class="button_1 point close_popup"><span>хорошо</span></button>
            </div>      
        </div>
    </div>

    <?= Alert::widget() ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
