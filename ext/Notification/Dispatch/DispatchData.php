<?php
namespace app\ext\Notification\Dispatch;

use app\models\User;

class DispatchData
{
    /**
     * @var User
     */
    public $sendFrom;

    /**
     * Array of User-model receivers
     * @var User[]
     */
    public $receivers;

    /**
     * Array of TextDataContainer indexed by appropriate userId
     * @var array
     */
    public $textDataContainers;

    public function __construct(User $userSendFrom, $userReceivers, $textDataContainers = [])
    {
        $this->sendFrom = $userSendFrom;
        $this->receivers = $userReceivers;
        $this->textDataContainers = $textDataContainers;
    }

}
