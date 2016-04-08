<?php
namespace app\ext\Notification;

use app\models\Notification;
use app\models\User;

class NfProcessor
{
    /**
     * @var Notification
     */
    private $notif;

    public function __construct(Notification $notif)
    {
        $this->notif = $notif;
    }

    public function process()
    {

    }

    private function defineSender()
    {
        /** @var User $user */
        $user = User::findOne($this->notif->sender);
        NfException::ensure(!is_null($user), "Sender not found");

        $sender = [
            'email' => $user->email,
            'name' => $user->username
        ];

        return $sender;
    }

    private function defineReceivers()
    {
        // direct user
        if ($this->notif->receiver > 0) {

        }
    }

}
