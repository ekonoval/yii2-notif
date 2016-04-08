<?php
namespace app\ext\Notification;

use app\models\Notification;

class NfProcessorMulti
{
    public function processEventType($eventType, $userInitiator)
    {
        $notifItems = Notification::find()->enabled()->where(['code' => $eventType])->all();

        if (empty($notifItems)) {
            return false;
        }

        pa($notifItems);

        return true;
    }
}
