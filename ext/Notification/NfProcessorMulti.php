<?php
namespace app\ext\Notification;

use app\models\Notification;

class NfProcessorMulti
{
    /**
     * @param $eventType
     * @param $eventRaiserModel
     * @return bool
     */
    public function processEventType($eventType, $eventRaiserModel)
    {
        $notifItems = Notification::find()->enabled()->where(['code' => $eventType])->all();

        if (empty($notifItems)) {
            return false;
        }

        /** @var Notification $nfItem */
        foreach ($notifItems as $nfItem) {
            $processor = new NfProcessor($nfItem, $eventRaiserModel);
            $processor->process();
        }

        return true;
    }
}
