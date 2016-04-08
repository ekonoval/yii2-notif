<?php

namespace app\controllers;

use app\ext\Notification\NfProcessor;
use app\models\Notification;
use Yii;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        $eventType = Notification::EVENT_USER_BLOCKED;

        $nfProcessor = new NfProcessor();
        $nfProcessor->processEventType($eventType);


    }
}
