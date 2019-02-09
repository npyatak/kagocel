<?php
use yii\helpers\Html;
use mihaildev\elfinder\ElFinder;

$this->title = 'Загрузить правила';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <span>Сохраните название файла правил для его отображения на сайте</span>
    <?= ElFinder::widget([
        'language'         => 'ru',
        'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter'           => 'application/pdf',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'path' => 'files',
        'frameOptions' => [
            'style' => 'height: 700px; width: 100%'
        ]
    ]);
    ?>
</div>
