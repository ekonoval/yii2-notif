<?php
namespace app\ext\Notification;

use app\models\Notification;
use yii\base\Behavior;

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

    public function handleUserBlocked($event)
    {
        pa($event);exit;
    }
}
