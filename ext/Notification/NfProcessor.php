<?php
namespace app\ext\Notification;

use app\models\Notification;

class NfProcessor
{
    public function processEventType($eventType)
    {
        $notifItems = Notification::find()->enabled()->where(['code' => $eventType])->all();

        if (empty($notifItems)) {
            return false;
        }

        pa($notifItems);

        return true;
    }
}
