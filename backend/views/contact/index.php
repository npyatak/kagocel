<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Contact;

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->status === Contact::STATUS_CLOSED) {
                    return ['class' => 'success'];
                } elseif($model->status === Contact::STATUS_READ) {
                    return ['class' => 'info'];
                }
            },
            'columns' => [
                'id',
                'name',
                'email',
                'phone',
                [
                    'attribute' => 'status',
                    'value' => function($data) {
                        return $data->statusArray[$data->status];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', Contact::getStatusArray(), ['prompt'=>'']),
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
