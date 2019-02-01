<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\User;
use common\models\UserAction;
use common\models\UserStageScore;
use common\models\UserChangeHistory;
use common\models\search\UserChangeHistorySearch;
use common\models\search\UserSearch;

class UserController extends CController
{

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionBan($id) {
        $model = $this->findModel($id);
        if($model->status === User::STATUS_BANNED) {
            $model->status = User::STATUS_ACTIVE;
        } else {
            $model->status = User::STATUS_BANNED;
        } 

        $model->save(false, ['status', 'updated_at']);

        return $this->redirect(Yii::$app->request->referrer);
    }
    
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

    public function actionChangeHistory()
    {
        $searchModel = new UserChangeHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith('user');
        $dataProvider->pagination->pageSize = 100;

        return $this->render('change-history', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id) 
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUnder18()
    {
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->modify('-18 years');

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['>', 'birthdate', $date->format('U')])->joinWith(['userStageScores', 'userCodes']);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('under-18', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCount()
    {
        $userActions = UserAction::find()->where(['type' => 1])->all();

        $count = 0;

        foreach ($userActions as $ua) {
            $params = json_decode($ua->params, true);

            if(isset($params['user_id']) && $params['user_id']) {
                $soc = User::find()->select(['soc'])->where(['id' => $params['user_id']])->column();

                if(!$soc[0]) {
                    $count++;
                }
            }
        }
            
        echo $count;
    }

    public function actionCheckUser($id = 81513) 
    {
        ini_set("display_errors", 0);
        $userActions = UserAction::find()->where(['type' => UserAction::TYPE_REFERRER_FIRST_CODE, 'user_id' => $id])->joinWith('user')->all();

        $res = [];
        foreach ($userActions as $act) {
            $arr = json_decode($act->params, true);

            if(is_array($arr) && isset($arr['user_id'])) {
                $user = User::findOne($arr['user_id']);
            
                if($user->status == User::STATUS_BANNED) {
                    $res[] = $user->id.' '.$user->name;
                }
            }
        }

        var_dump(implode(', ', $res));
    }

    public function actionGetValidEmailIds()
    {      
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->modify('-18 years');

        $users = User::find()
            ->select(['id', 'name', 'email_subscribe', 'email'])
            ->where(['email_subscribe' => 1, 'status' => User::STATUS_ACTIVE])
            ->andWhere(['not', ['email' => null]])
            ->andWhere(['<', 'birthdate', $date->format('U')])
            ->limit(1000)
            ->orderBy('id ASC')
            ->asArray()
            ->all();

        $res = [];
        $user = new User;
        foreach ($users as $key => $u) {
            $user->email = $u['email'];
            $user->validate();

            if(!isset($user->errors['email'])) {
                $res[] = $u['id'];
            } else {
                echo $u['email'];
                echo '<br>';
            }
            if(count($res) == 400) {
                break;
            }
        }

        echo '<br>';
        echo $key;
        echo '<br>';
        echo '<br>';
        echo implode(',', $res);
    }

    public function actionExportEmails()
    {
        ini_set('memory_limit', '-1');

        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->modify('-18 years');

        $users = User::find()
            ->select(['id', 'name', 'email_subscribe', 'email'])
            ->where(['email_subscribe' => 1])
            ->andWhere(['not', ['email' => null]])
            ->andWhere(['<', 'birthdate', $date->format('U')])
            ->indexBy('id')
            ->asArray()
            ->all();
        
        if(!empty($users)) {
            $sheets = [];
            foreach ($users as $uc) {
                $sheets['Пользователи']['data'][] = [$uc['email'], $uc['name']];
            }
            $sheets['Пользователи']['titles'] = [
                'Email',
                'Имя',
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

            $file->send('userEmails.xlsx');
        } else {
            echo 'Нет результатов';
        }
    }

    public function actionUserFriends($id)
    {
        $userActions = UserAction::find()->where(['in', 'type', [UserAction::TYPE_REFERRER_REGISTER, UserAction::TYPE_REFERRER_FIRST_CODE]])->andWhere(['user_id' => $id])->all();

        $ids = [];
        foreach ($userActions as $ua) {
            $arr = json_decode($ua['params'], true);
            if(isset($arr['user_id'])) {
                $ids[] = $arr['user_id'];
            }
        }

        $users = User::find()
            ->select(['user.id', 'name', 'email', 'phone'])
            ->joinWith('userCodes')
            ->where(['in', 'user.id', $ids])
            ->asArray()
            ->all();

        if(!empty($users)) {
            $sheets = [];
            foreach ($users as $uc) {
                $cArr = [];
                if(!empty($uc['userCodes'])) {
                    foreach ($uc['userCodes'] as $c) {
                        $cArr[] = $c['code'];
                    }
                }
                $codeStr = count($uc['userCodes']).': '.implode(', ', $cArr);

                $sheets['Пользователи']['data'][] = [$uc['id'], $uc['email'], $uc['name'], $uc['phone'], $codeStr];
            }
            $sheets['Пользователи']['titles'] = [
                'ID',
                'Email',
                'Имя',
                'Телефон',
                'Коды',
            ];

            $file = \Yii::createObject([
                'class' => 'codemix\excelexport\ExcelFile',
                'sheets' => $sheets
            ]);

            $file->createSheets();

            foreach ($file->getWorkbook()->getAllSheets() as $key => $sheet) {
                foreach(range('A','D') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            }

            $file->send('userFriends.xlsx');
            exit;
        } else {
            echo 'Нет результатов';
        }
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
