<?php

namespace app\controllers;

use app\ext\Misc\FlashMessageCreator;
use app\models\NotificationBrowserDispatch;
use app\models\SignupForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'cabinet'],
                'rules' => [
                    [
                        'actions' => ['logout', 'cabinet'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect('/site/cabinet');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            (new FlashMessageCreator())->addSuccess('You have been successfully registered');
            return $this->goBack();
        }
        return $this->render('signup_tpl', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCabinet()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => NotificationBrowserDispatch::find()
                ->where([
                    //'status' => NotificationBrowserDispatch::STATUS_UNREAD,
                    'receiver_id' => Yii::$app->user->id
                ])
                ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->render('cabinet_tpl', ['dataProvider' => $dataProvider]);
    }
}
