<?php

namespace app\controllers;

use app\ext\Notification\NfProcessorMulti;
use app\models\Notification;
use Yii;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        $eventType = Notification::EVENT_USER_BLOCKED;

        $nfProcessor = new NfProcessorMulti();
        $nfProcessor->processEventType($eventType);


    }
}
