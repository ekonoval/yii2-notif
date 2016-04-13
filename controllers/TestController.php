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
        $eventType = Notification::EVENT_USER_REGISTERED;
        $raiser = User::findOne(5);

        //$eventType = Notification::EVENT_ARTICLE_CREATED; $raiser = Article::findOne(1);

        $nfProcessor = new NfProcessorMulti();
        $nfProcessor->processEventType($eventType, $raiser);

        return new Response();
    }
}
