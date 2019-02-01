<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->status == User::STATUS_BANNED) {
                echo Html::a('Вернуть из бана', ['ban', 'id' => $model->id, 'status' => User::STATUS_ACTIVE], ['class' => 'btn btn-success']);
            } else {
                echo Html::a('Забанить', ['ban', 'id' => $model->id, 'status' => User::STATUS_BANNED], ['class' => 'btn btn-danger']);
            }
        ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'soc',
            'sid',
            'name',
            'email',
            'phone',
            [
                'attribute' => 'birthdate',
                'value' => function($model) {
                    return date('d.m.Y', $model->birthdate);
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->statusLabel;
                }
            ],
            'ip',
            'browser',
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>
