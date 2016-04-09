<?php
namespace app\ext\Notification\Dispatch;

use app\models\User;

class DispatchData
{
    public $sendFrom;
    public $receivers;
    public $textDataContainers;

    public function __construct(User $userSendFrom, $userReceivers, $textDataContainers = [])
    {
        $this->sendFrom = $userSendFrom;
        $this->receivers = $userReceivers;
        $this->textDataContainers = $textDataContainers;
    }


}
