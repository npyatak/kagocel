<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\User;
use common\models\Stage;

class CController extends Controller
{

    public function beforeAction($action) 
    {
        if(!Yii::$app->user->isGuest && Yii::$app->controller->action->id !== 'user-data' && !empty(Yii::$app->user->identity->missingFields)) {
            return $this->redirect(Url::toRoute('personal/user-data'));
        }

        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isUnder18()) {
            Yii::$app->user->logout();
            Yii::$app->getSession()->setFlash('error', 'В соответствии с п. 3.4. <a href="'.Url::toRoute(['site/rules']).'">правил конкурса</a> в Конкурсе могут принять участие граждане Российской Федереции, достигшие 18 лет');            
        }


        return parent::beforeAction($action);
    }
}