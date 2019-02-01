<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\User;
use common\models\Stage;
use common\models\UserStageScore;

$this->title = 'Баллы пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->user->status === User::STATUS_BANNED) {
                    return ['class' => 'danger'];
                }
            },
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
                    'attribute' => 'stage_id',
                    'value' => function($data) {
                        return $data->stage->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'stage_id', ArrayHelper::map(Stage::find()->where(['type' => Stage::TYPE_MAIN])->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                'score',
                [
                    'attribute' => 'console',
                    'value' => function($data) {
                        return UserStageScore::getConsoleArray()[$data->console];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'console', UserStageScore::getConsoleArray(), ['prompt'=>'']),
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = Url::toRoute(['/user-action/index', 'UserActionSearch[user_id]' => $model->user_id]);
                            return Html::a('<span class="glyphicon glyphicon-list"></span>', $url, ['title' => 'Список действий']);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
