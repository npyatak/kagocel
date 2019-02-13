<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\base\Model;

use common\models\Stage;
use common\models\User;
use common\models\Winner;
use common\models\search\StageSearch;


class StageController extends CController
{
    public function actionIndex()
    {
        $searchModel = new StageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Stage();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id) 
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionWinners($id, $i = null) 
    {
        $stage = $this->findModel($id);

        $winners = Winner::find()->where(['stage_id' => $id])->all();
        if(empty($winners)) {
            $winners = [new Winner, new Winner, new Winner, new Winner, new Winner];
        }

        $winnerIds = [];
        $oldIds = Winner::find()->select('id')->where(['stage_id' => $id])->column();

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_winner', [
                'winner' => new Winner,
                'i' => $i,
                'stage' => $stage,
            ]);
        } elseif(Model::loadMultiple($winners, Yii::$app->getRequest()->post()) && Model::validateMultiple($winners)) {
            $transaction = Yii::$app->db->beginTransaction();            
            try  {
                $success = true;

                $winners = [];
                foreach (Yii::$app->getRequest()->post()['Winner'] as $pw) {
                    if(isset($pw['id']) && $pw['id']) {
                        $winner = Winner::findOne($pw['id']);
                        $winnerIds[] = $pw['id'];
                    } else {
                        $winner = new Winner;
                    }
                    $winner->load($pw);
                    $winner->attributes = $pw;
                    $winner->stage_id = $id;

                    $success = $winner->save();
                    $winners[] = $winner;
                }

                foreach (array_diff($oldIds, $winnerIds) as $idToDel) {
                    Winner::findOne($idToDel)->delete();
                }

                if($success) {
                    $transaction->commit();
                    Yii::$app->session->setFlash("success", 'Данные успешно обновлены');

                    return $this->redirect(['winners', 'id' => $id]);
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('winners', [
            'stage' => $stage,
            'winners' => $winners,
        ]);
    }

    /**
     * Deletes an existing Stage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
