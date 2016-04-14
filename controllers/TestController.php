<?php

namespace app\controllers;

use app\ext\Notification\NfProcessorMulti;
use app\models\Article;
use app\models\Notification;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class TestController extends Controller
{

    public function actionIndex()
    {
        $eventType = Notification::EVENT_USER_BLOCKED;
//        $eventType = Notification::EVENT_USER_REGISTERED;
        $raiser = User::findOne(1);

        $eventType = Notification::EVENT_ARTICLE_CREATED; $raiser = Article::findOne(2);

        $nfProcessor = new NfProcessorMulti();
        $nfProcessor->processEventType($eventType, $raiser);

        pa('done'); exit;

        return new Response();
    }

    public function actionJunction()
    {
        $res = Notification::findOne(1);

        pa($res->types);
    }
}
