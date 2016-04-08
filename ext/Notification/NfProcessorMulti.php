<?php
namespace app\ext\Notification;

use app\models\Notification;

class NfProcessorMulti
{
    public function processEventType($eventType, $eventSender)
    {
        $notifItems = Notification::find()->enabled()->where(['code' => $eventType])->all();

        if (empty($notifItems)) {
            return false;
        }

        /** @var Notification $nfItem */
        foreach ($notifItems as $nfItem) {
            $processor = new NfProcessor($nfItem, $eventSender);
            $processor->process();
        }

        return true;
    }
}
