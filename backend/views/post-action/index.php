<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\PostAction;

$this->title = 'Действия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],
                [
                    'attribute' => 'post_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->post->id, Url::toRoute(['post/view', 'id'=>$data->post->id]));
                    }
                ],
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->user->name ? $data->user->fullName : $data->user_id, Url::toRoute(['user/view', 'id' => $data->user_id]));
                    }
                ],
                [
                    'attribute' => 'type',
                    'value' => function($data) {
                        return $data->typeLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'type', PostAction::getTypeArray(), ['prompt'=>'']),
                ],
                'score',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
