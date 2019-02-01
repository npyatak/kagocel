<?php

namespace backend\controllers;

use Yii;
use common\models\PostAction;
use common\models\search\PostActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostActionController implements the CRUD actions for PostAction model.
 */
class PostActionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PostAction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['user', 'post']);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBan($id) {
        $model = $this->findModel($id);
        if($model->status === PostAction::STATUS_BANNED) {
            $model->status = PostAction::STATUS_ACTIVE;
        } else {
            $model->status = PostAction::STATUS_BANNED;
        }
        $model->save(false, ['status']);

        return $this->redirect(['index']);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PostAction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostAction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostAction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
