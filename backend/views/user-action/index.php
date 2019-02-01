<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Stage;
use common\models\UserAction;

$this->title = 'Действия пользователей';
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
                    'attribute' => 'type',
                    'value' => function($data) {
                        return $data->getTypeLabels()[$data->type];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'type', UserAction::getTypeLabels(), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'stage_id',
                    'value' => function($data) {
                        return $data->stage->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'stage_id', ArrayHelper::map(Stage::find()->where(['type' => Stage::TYPE_MAIN])->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                'score',
                [
                    'attribute' => 'params',
                    'value' => function($data) {
                        return $data->params;
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],
                /*[
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                ],*/
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
