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

    private $eventSender;

    public function __construct(Notification $notif, $eventSender)
    {
        $this->notif = $notif;
        $this->eventSender = $eventSender;
    }

    public function process()
    {
        $sender = $this->defineSender();
        $receivers = $this->defineReceivers();

        pa($sender, $receivers);
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
        $receivers = [];
        $receiverId = $this->notif->receiver;

        // direct user
        if ($receiverId > 0) {

        } elseif ($receiverId == Notification::RECEIVER_OWNER_ID) {
            NfException::ensure($this->eventSender instanceof User, "Incorrect event sender param for {$this->notif->code}");

            /** @var User $user */
            $user = $this->eventSender;
            $receivers[] = [
                'name' => $user->username,
                'email' => $user->email,
            ];

        } elseif ($receiverId == Notification::RECEIVER_ALL_ID) {

        }

        return $receivers;
    }

}
