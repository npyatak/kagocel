<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\User;

$this->title = 'Пользователи до 18';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->status === User::STATUS_BANNED) {
                    return ['class' => 'danger'];
                } elseif($model->status === User::STATUS_BAN_WITH_HISTORY_SAVE) {
                    return ['class' => 'warning'];
                }
            },
            'columns' => [
                'id',
                /*'soc',
                'sid',*/
                'name',
                'email',
                'phone',
                /*[
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->image, ['width' => '100px']);
                    }
                ],*/
                [
                    'attribute' => 'status',
                    'value' => function($data) {
                        return $data->statusLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', User::getStatusArray(), ['prompt'=>'']),
                ],
                'ip',
                [
                    'attribute' => 'birthdate',
                    'value' => function($data) {
                        $bd = new DateTime();
                        $bd->setTimestamp($data->birthdate);
                        $now = new DateTime();
                        return $bd->format('d.m.Y').' ('.$now->diff($bd)->format('%y').')';
                    }
                ],
                [
                    'attribute' => 'userStageScores',
                    'format' => 'raw',
                    'value' => function($data) {
                        $arr = [];
                        foreach ($data->userStageScores as $userStageScore) {
                            $arr[] = $userStageScore->stage_id.') '.$userStageScore->score;
                        }

                        return implode('<br>', $arr);
                    }
                ],
                [
                    'attribute' => 'userCodes',
                    'format' => 'raw',
                    'value' => function($data) {
                        $arr = [];
                        foreach ($data->userCodes as $userCode) {
                            $isActivated = $userCode->is_activated ? 'активирован' : 'не активирован';
                            $arr[] = $userCode->code.' - '.$isActivated;
                        }

                        return implode('<br>', $arr);
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {ban} {delete}',
                    'buttons' => [
                        'ban' => function ($url, $model) {
                            $url = Url::toRoute(['/user/ban', 'id'=>$model->id]);
                            if($model->status === User::STATUS_ACTIVE) {
                                $link = Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, ['title' => 'Забанить с сохранением результата', 'class' => 'text-warning']);
                            } elseif($model->status === User::STATUS_BAN_WITH_HISTORY_SAVE) {
                                $link = Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, ['title' => 'Забанить', 'class' => 'text-danger']);
                            } else {
                                $link = Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, ['title' => 'Вернуть из бана', 'class' => 'text-success']);
                            }
                            return $link;
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
