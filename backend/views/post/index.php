<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Post;
use common\models\Stage;

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model) {
                if($model->status === Post::STATUS_BANNED) {
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'stage_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->stage->name, Url::toRoute(['stage/view', 'id' => $data->stage_id]));
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'stage_id', ArrayHelper::map(Stage::find()->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->user->name ? $data->user->fullName : $data->user_id, Url::toRoute(['user/view', 'id' => $data->user_id]));
                    }
                ],
                [
                    'attribute' => 'audio',
                    'value' => function($data) {
                        return $data->audio;
                    },
                ],
                [
                    'attribute' => 'score',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->score, Url::toRoute(['post-action/index', 'PostActionSearch[post_id]' => $data->id]));
                    },
                ], 
                [
                    'attribute' => 'status',
                    'value' => function($data) {
                        return $data->statusLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', Post::getStatusArray(), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{ban} {delete}',
                    'buttons' => [
                        'ban' => function ($url, $model) {
                            $url = Url::toRoute(['/post/ban', 'id'=>$model->id]);
                            return $model->status === Post::STATUS_ACTIVE ? Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, ['title' => 'Забанить']) : Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', $url, ['title' => 'Вернуть из бана']);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
