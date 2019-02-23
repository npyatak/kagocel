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
use common\models\Post;

class PersonalController extends CController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() 
    {
        $user = User::findOne(Yii::$app->user->id);
        $stage = Stage::getCurrent(Stage::TYPE_MAIN);

        $userStagePosts = Post::find()
            ->where(['stage_id' => $stage->id, 'user_id' => $user->id, 'status' => Post::STATUS_ACTIVE])
            ->orderBy('id DESC')
            ->all();
        
        $userOldPosts = Post::find()
            ->where(['user_id' => $user->id, 'status' => Post::STATUS_ACTIVE])
            ->andWhere(['not', ['stage_id' => $stage->id]])
            ->orderBy('id DESC')
            ->all();
        
        $otherPosts = Post::find()
            ->where(['stage_id' => $stage->id, 'post.status' => Post::STATUS_ACTIVE, 'user.status' => Post::STATUS_ACTIVE])
            ->andWhere(['not', ['user_id' => $user->id]])
            ->joinWith('user')
            ->limit(3)
            ->orderBy('id DESC')
            ->all();

        return $this->render('index', [
            'user' => $user,
            'stage' => $stage,
            'userStagePosts' => $userStagePosts,
            'userOldPosts' => $userOldPosts,
            'otherPosts' => $otherPosts,
        ]);
    }

    public function actionAddPost() 
    {
        $user = User::findOne(Yii::$app->user->id);
        $stage = Stage::getCurrent(Stage::TYPE_MAIN);

        $userStagePosts = Post::find()
            ->where(['stage_id' => $stage->id, 'user_id' => $user->id, 'status' => Post::STATUS_ACTIVE])
            ->orderBy('id DESC')
            ->all();
        
        $userOldPosts = Post::find()
            ->where(['user_id' => $user->id, 'status' => Post::STATUS_ACTIVE])
            ->andWhere(['not', ['stage_id' => $stage->id]])
            ->orderBy('id DESC')
            ->all();
        
        $otherPosts = Post::find()
            ->where(['stage_id' => $stage->id, 'post.status' => Post::STATUS_ACTIVE, 'user.status' => Post::STATUS_ACTIVE])
            ->andWhere(['not', ['user_id' => $user->id]])
            ->joinWith('user')
            ->limit(3)
            ->orderBy('id DESC')
            ->all();

        return $this->render('add-post', [
            'user' => $user,
            'stage' => $stage,
            'userStagePosts' => $userStagePosts,
            'userOldPosts' => $userOldPosts,
            'otherPosts' => $otherPosts,
        ]);
    }

    public function actionUserData() 
    {
        $user = User::findOne(Yii::$app->user->id);

        if($user->load(Yii::$app->request->post())) {
            $user->scenario = 'missing_fields';
            if(Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($user);
            }

            $user->save();
            Yii::$app->session->setFlash("success", 'Данные успешно обновлены');

            return $this->redirect(['personal/index']);
        }

        return $this->render('user-data', [
            'user' => $user,
        ]);
    }
}