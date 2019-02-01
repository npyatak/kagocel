<?php

use yii\helpers\Html;

use common\models\Stage;

$this->title = 'Добавить этап';
$this->params['breadcrumbs'][] = ['label' => 'Этапы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="week-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
