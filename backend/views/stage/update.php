<?php
use yii\helpers\Html;

use common\models\Stage;

$this->title = 'Обновить этап ' . $model->number. ' ('.$model->name.')';
$this->params['breadcrumbs'][] = ['label' => 'Этапы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->number. ' ('.$model->name.')', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="week-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
