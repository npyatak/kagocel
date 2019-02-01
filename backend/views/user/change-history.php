<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\User;

$this->title = 'История изменения данных';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->user->name, Url::toRoute(['user/view', 'id' => $data->user->id])).' ('.$data->user->id.')';
                    },
                ],
                [
                    'attribute' => 'changed_values',
                    'format' => 'raw',
                    'value' => function($data) {
                        $arr = json_decode($data->changed_values, true);

                        return implode('<br>', $arr);
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
