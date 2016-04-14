<?php
namespace app\ext\Notification;

use app\models\Notification;
use yii\base\Behavior;
use yii\base\Event;

class NfBehavior extends Behavior
{
    //public $eventsToListen;

    public function events()
    {
        $events = [
            Notification::EVENT_USER_BLOCKED => 'handleEvent',
            Notification::EVENT_USER_REGISTERED => 'handleEvent',
            Notification::EVENT_ARTICLE_CREATED => 'handleEvent',
        ];

        return $events;
    }

    public function handleEvent(Event $event)
    {
        $nfProcessorMuli = new NfProcessorMulti();
        $nfProcessorMuli->processEventType($event->name, $event->sender);
    }
}
