<?php

namespace backend\controllers;

use Yii;
use common\models\UserStageScore;
use common\models\search\UserStageScoreSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UserStageScoreController extends CController
{

    public function actionIndex()
    {
        $searchModel = new UserStageScoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 100;
        $dataProvider->query->joinWith('stage');
        $dataProvider->sort = [
            'defaultOrder' => ['id'=>SORT_DESC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = UserStageScore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
