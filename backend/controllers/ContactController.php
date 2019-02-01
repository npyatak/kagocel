<?php

namespace backend\controllers;

use Yii;
use common\models\Contact;
use common\models\search\ContactSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends CController
{
    /**
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 100;
        $dataProvider->sort = [
            'defaultOrder' => ['id' => SORT_DESC]
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if($model->status == Contact::STATUS_NEW) {
            $model->status = Contact::STATUS_READ;
            $model->save(false, ['status']);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionExport()
    {
        ini_set('memory_limit', '-1');

        $contacts = Contact::find()->all();
        
        if(!empty($contacts)) {
            $sheets = [];
            foreach ($contacts as $contact) {
                $sheets['Сообщения']['data'][] = [
                    $contact['name'], 
                    $contact['email'], 
                    $contact['phone'], 
                    $contact['body'], 
                    $contact->statusArray[$contact['status']],
                    date('d.m.Y H:i', $contact['created_at'])
                ];
            }
            $sheets['Сообщения']['titles'] = [
                'Имя',
                'Email',
                'Телефон',
                'Сообщение',
                'Статус',
                'Дата',
            ]; 

            $file = \Yii::createObject([
                'class' => 'codemix\excelexport\ExcelFile',
                'sheets' => $sheets
            ]);

            $file->createSheets();

            foreach ($file->getWorkbook()->getAllSheets() as $key => $sheet) {
                foreach(range('A','F') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            }

            $file->send('contacts.xlsx');
        } else {
            echo 'Нет результатов';
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contact model.
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
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
