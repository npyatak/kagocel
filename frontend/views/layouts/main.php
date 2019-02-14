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

    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/favicon/tnt-144.png">
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

    <?php if($_SERVER['HTTP_HOST'] != 'kagocel.local'):?>

    <?php endif;?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">

    
        <?php $menuItems = [
            ['label' => 'Главная', 'c' => 'site', 'a' => 'index'],
            ['label' => 'Личный кабинет', 'c' => 'personal', 'a' => 'index'],
            ['label' => 'Галерея', 'c' => 'site', 'a' => 'gallery'],
            ['label' => 'О продукте', 'c' => 'site', 'a' => 'about'],
            ['label' => 'Обратная связь', 'c' => 'site', 'a' => 'contact'],
            ['label' => 'Faq', 'c' => 'site', 'a' => 'faq'],
            ['label' => 'Правила', 'c' => 'site', 'a' => 'rules'],
        ];?>


        <header class="header_main">
            <div class="contain">
                <div class="burger_button">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
                <a class="logo_1" href="#">
                    <img src="/img/logo_1.svg" alt="logo">
                </a>
                <nav class="main_menu">
                    <ul>
                        <?php foreach ($menuItems as $item):?>
                            <?php $active = Yii::$app->controller->id == $item['c'] && Yii::$app->controller->action->id == $item['a'];?>
                            <li><a href="<?=Url::toRoute($item['c'].'/'.$item['a']);?>" <?=$active ? 'class="active"' : '';?>><?=$item['label'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                </nav>
                <a class="logo_2" href="#">
                    <img src="/img/logo_2.svg" alt="logo">
                </a>
            </div>
        </header>



        <div class="burger_menu">
            <div class="contain">
                <img class="close_burger" src="/img/close_middle.svg" alt="close">
                <ul class="burger_ul">
                    <?php foreach ($menuItems as $item):?>
                        <?php $active = Yii::$app->controller->id == $item['c'] && Yii::$app->controller->action->id == $item['a'];?>
                        <li><a href="<?=Url::toRoute($item['c'].'/'.$item['a']);?>" <?=$active ? 'class="active"' : '';?>><?=$item['label'];?></a></li>
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
                            <a class="footer_logo" href="#"><img src="/img/logo_1_2.svg" alt="logo"></a>
                            <a class="footer_logo" href="#"><img src="/img/logo_2_2.svg" alt="logo"></a>
                        </div>

                        <nav class="footer_menu">
                            <ul>
                                <?php foreach ($menuItems as $item):?>
                                    <?php $active = Yii::$app->controller->id == $item['c'] && Yii::$app->controller->action->id == $item['a'];?>
                                    <li><a href="<?=Url::toRoute($item['c'].'/'.$item['a']);?>" <?=$active ? 'class="active"' : '';?>><?=$item['label'];?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </nav>

                        <div class="footer_text_block">
                           <div class="text">
                               <p>
                                   Общий период конкурса, включая выдачу призов: с 04 марта по ** мая 2019 года. Период приёма конкурсных работ с 04 марта по 29 марта 2019 года. Подробности об организаторе конкурса, правилах его проведения, количестве подарков по его результатам, сроках, месте и порядке их получения смотри <a href="#" target="_blanck">тут</a>.
                               </p>
                               <p>
                                   внешний вид призов может отличаться от изображенияв рекламных материалах
                               </p>
                           </div>
                       
                           <p class="copyright">© Copyright 2019 ОАО «ТНТ-телесеть». Все права защищены</p>
                       </div>
                    </div>

                    <p class="sixteen_item">16<span>+</span></p>

                </div>
            </div>
            <!-- footer_top -->

            <div class="footer_bottom">
                <p>Имеются противопоказания. необходимо ознакомиться с инструкцией или проконсультироваться со специалистом</p>
            </div>
        </footer>
    </div>
            
    <?= Alert::widget() ?>
    

    <?php if($_SERVER['HTTP_HOST'] != 'kagocel.local'):?>

    <?php endif;?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
