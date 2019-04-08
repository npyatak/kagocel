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
use yii\data\ActiveDataProvider;

use frontend\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\RestorePasswordForm;

use common\models\User;
use common\models\PostAction;
use common\models\Stage;
use common\models\Post;
use common\models\Faq;
use common\models\Contact;

/**
 * Site controller
 */
class SiteController extends CController
{

    public function behaviors()
    {
        return [
            'eauth' => [
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => ['login'],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'missing-fields', 'rating'],
                'rules' => [
                    [
                        'actions' => ['logout', 'missing-fields', 'rating'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'personalme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $stage = Stage::getCurrent(Stage::TYPE_MAIN);

        return $this->render('index', [
            'stage' => $stage,
        ]);
    }

    public function actionLogin() 
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        $ref = Yii::$app->getRequest()->getQueryParam('ref');

        if (isset($serviceName)) {
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Url::toRoute('site/gallery'));
            if($ref && $ref !== '' && $ref !== '/login') {
                $eauth->setRedirectUrl(Url::to($ref));
            }
            $eauth->setCancelUrl(Url::toRoute('site/login'));

            try {
                if ($eauth->authenticate()) {
                    $user = User::findByService($serviceName, $eauth->id);

                    if($user === null) {
                        $user = new User;
                        $user->soc = $serviceName;
                        $user->sid = $eauth->id;
                        $user->name = $eauth->first_name;
                        $user->surname = $eauth->last_name;
                        if(isset($eauth->email)) {
                            $mailExists = User::find()->where(['email' => $eauth->email])->exists();
                            if(!$mailExists) {
                                $user->email = $eauth->email;
                            }
                        }
                        if(isset($eauth->birthdate)) {
                            $user->birthdate = $eauth->birthdate;

                            $bd = new \DateTime();
                            $bd->setTimestamp($user->birthdate);
                            $now = new \DateTime();
                            if($now->diff($bd)->format('%y') < 18) {
                                Yii::$app->getSession()->setFlash('error', 'Ты не можешь быть участником, так как ты младше 18 лет');
                                
                                $eauth->redirect($eauth->getCancelUrl());
                            }
                        } 
                        $user->image = isset($eauth->photo_url) ? $eauth->photo_url : null;
                    } elseif($user->status !== User::STATUS_ACTIVE) {
                        Yii::$app->getSession()->setFlash('error', 'Вы не можете войти. Ваш аккаунт заблокирован');
                        
                        $eauth->redirect($eauth->getCancelUrl());
                    }
                    
                    $user->ip = $_SERVER['REMOTE_ADDR'];
                    $user->browser = $_SERVER['HTTP_USER_AGENT'];
                    $user->save(false);

                    Yii::$app->user->login($user, 3600 * 24 * 365);

                    $eauth->redirect();
                } else {
                    $eauth->cancel();
                    $eauth->redirect($eauth->getCancelUrl());
                }
            } catch (\nodge\eauth\ErrorException $e) {
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

                $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        return $this->render('login');
    }

    public function actionPost($id) 
    {
        $post = $this->findPost($id);
        $stage = Stage::getCurrent(Stage::TYPE_MAIN);

        $stagePosts = null;
        if($stage) {
            $stagePosts = Post::find()->where(['stage_id' => $stage->id, 'status' => Post::STATUS_ACTIVE])->all();
        }

        return $this->render('post', [
            'post' => $post,
            'stage' => $stage,
            'stagePosts' => $stagePosts,
        ]);
    }

    public function actionGallery()
    {
        $stage = Stage::getCurrent(Stage::TYPE_MAIN);

        $stagePosts = null;
        if($stage !== null) {
            $stagePosts = Post::find()->where(['stage_id' => $stage->id, 'status' => Post::STATUS_ACTIVE])->all();
        }

        $finishedStages = Stage::find()->where(['<', 'date_end', time()])->indexBy('id')->all();

        $finalWinnerPost = Post::findOne(170);

        return $this->render('gallery', [
            'stage' => $stage,
            'stagePosts' => $stagePosts,
            'finishedStages' => $finishedStages,
            'finalWinnerPost' => $finalWinnerPost,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::toRoute(['site/index']));
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if(!Yii::$app->user->isGuest) {
            $model->email = Yii::$app->user->identity->email;
            $model->name = Yii::$app->user->identity->name;
            $model->phone = Yii::$app->user->identity->phone;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $contact = new Contact;
            $contact->attributes = $model->attributes;

            $contact->save();
            
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Спасибо, ваша заявка отправлена!');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при отправлении сообщения.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionRules() 
    {
        $filename = 'rules_kagocel.pdf';
        $completePath = __DIR__.'/../web/files/'.$filename;
        if(!is_file($completePath)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return Yii::$app->response->sendFile($completePath, $filename, ['inline'=>true, 'Content-type' => 'application/pdf', 'Content-Disposition' => 'attachment']);
    }

    public function actionFaq()
    {
        $faq = Faq::find()->orderBy('order ASC')->all();

        return $this->render('faq', [
            'faq' => $faq,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPostAction($id, $type) 
    {        
        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post = $this->findPost($id);

            if($post !== null && $post->userCan($type)) {
                if(in_array($type, [PostAction::TYPE_SHARE_VK, PostAction::TYPE_SHARE_FB, PostAction::TYPE_SHARE_OK]) && $post->user_id !== Yii::$app->user->id) {
                    return ['status' => 'error'];
                }

                $postAction = new PostAction();
                $postAction->post_id = $id;
                $postAction->type = $type;
                $postAction->user_id = Yii::$app->user->id;

                if($postAction->validate()) {
                    $postAction->score = $postAction->scoreInitial;

                    $postAction->save(false);

                    $newScore = Post::find()->select('score')->where(['id' => $id])->column();
                    return ['status' => 'success', 'score' => $newScore];
                }
            }

            return ['status' => 'error'];
        }
    }

    public function actionUnsubscribe($user_id, $code)
    {
        $user = User::findOne($user_id);

        if ($user === null || $code !== $user->unsubscribeCode) {
            throw new InvalidParamException('Неправильный токен для отписки.');
        }

        $user->email_subscribe = 0;
        $user->save(false, ['email_subscribe']);
              
        Yii::$app->session->setFlash('success', 'Вы успешно отписались от всех рассылок сайта.');
            
        return $this->redirect(['personal/index']);
    }

    public function actionLogin2($id = 1) {
        $user = User::findOne($id);

        Yii::$app->getUser()->login($user);

        return $this->redirect('/');
    }

    protected function findPost($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
