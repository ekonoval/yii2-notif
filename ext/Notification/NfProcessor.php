<?php
namespace app\ext\Notification;

use app\ext\Notification\Code\CodeEventUserBlocked;
use app\models\Notification;
use app\models\User;
use app\ext\Notification\Type\NfEmailTypeProcessor;

class NfProcessor
{
    /**
     * @var Notification
     */
    private $notif;

    /**
     * @var IAbleToNotify
     */
    private $eventRaiserModel;

    /**
     * TODO - fetch it from real cross table
     * @var array
     */
    private $notifTypes = [Notification::TYPE_EMAIL];

    public function __construct(Notification $notif, IAbleToNotify $eventRaiserModel)
    {
        $this->notif = $notif;
        $this->eventRaiserModel = $eventRaiserModel;
    }

    public function process()
    {
        $sender = $this->defineSender();
        $receivers = $this->defineReceivers();

        //pa($sender, $receivers);

        $dispatchData = null;

        if ($this->notif->code == Notification::EVENT_USER_BLOCKED) {
            $codeProcessor = new CodeEventUserBlocked($this->eventRaiserModel, $this->notif, $sender, $receivers);
            $dispatchData = $codeProcessor->prepareDispatchData();
            pa($dispatchData); exit;
        }



//        $nfEmailTypeProcessor = new NfEmailTypeProcessor($this->notif, $sender, $receivers);
//        $nfEmailTypeProcessor->prepareDispatchData();
    }

    private function defineSender()
    {
        /** @var User $user */
        $user = User::findOne($this->notif->sender);
        NfException::ensure(!is_null($user), "Sender not found");

        return $user;
    }

    private function defineReceivers()
    {
        $receivers = [];
        $receiverId = $this->notif->receiver;

        // direct user
        if ($receiverId > 0) {

        } elseif ($receiverId == Notification::RECEIVER_OWNER_ID) {
            NfException::ensure($this->eventRaiserModel instanceof User, "Incorrect event sender param for {$this->notif->code}");

            /** @var User $user */
            $user = $this->eventRaiserModel;
            $receivers[$user->primaryKey] = $user;

        } elseif ($receiverId == Notification::RECEIVER_ALL_ID) {

        }

        return $receivers;
    }

}
