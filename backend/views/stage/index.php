<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Stage;
use common\models\UserGameWinner;

$this->title = 'Этапы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="week-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить этап', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->isCurrent()) {
                    return ['class' => 'success'];
                }
            },
            'columns' => [
                'number',
                'name',
                [
                    'attribute' => 'date_start',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->date_start);
                    }
                ],
                [
                    'attribute' => 'date_end',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->date_end);
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{winners} {update} {delete}',
                    'buttons' => [
                        'winners' => function ($url, $model) {
                            $url = Url::toRoute(['/stage/winners', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-gift"></span>', $url, ['title' => 'Победители']);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
