<?php
namespace app\ext\Notification;

use app\models\Notification;
use yii\base\Behavior;
use yii\base\Event;

class NfBehavior extends Behavior
{
    public $eventsToListen;

    public function events()
    {
        $events = [
            Notification::EVENT_USER_BLOCKED => 'handleUserBlocked'
        ];

        return $events;
    }

    public function handleUserBlocked(Event $event)
    {
        $nfProcessorMuli = new NfProcessorMulti();
        $nfProcessorMuli->processEventType(Notification::EVENT_USER_BLOCKED, $event->sender);

        pa($event);exit;
//        pa($event);exit;
    }
}
