<?php
namespace app\ext\Notification;

use app\models\Notification;

/**
 * Of course it's not the optimal way to process heavy and long lasting email dispatch right after event rising.
 * The better way is to push that event to queue (RabbtiMQ maybe) and process it separately.
 * But it's the fastest way for the beginning.
 *
 * Handle event and all notifications linked to that event from "Notification crud" backend section
 */
class NfProcessorMulti
{
    /**
     * @param $eventType
     * @param IAbleToNotify $eventRaiserModel
     * @return bool
     */
    public function processEventType($eventType, IAbleToNotify $eventRaiserModel)
    {
        $notifItems = Notification::find()->enabled()->andWhere(['code' => $eventType])->all();

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
