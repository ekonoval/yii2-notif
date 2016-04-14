<?php
namespace app\ext\Notification\Dispatch\Transport;

use app\ext\Notification\Dispatch\DispatchData;
use app\ext\Notification\Dispatch\DispatchException;
use app\ext\Notification\Placeholderable\TextDataContainer;
use app\models\Notification;
use app\models\User;

abstract class TransportBase
{
    /**
     * @var DispatchData
     */
    protected $dispatchData;

    /**
     * @var Notification
     */
    protected $notif;

    public function __construct(DispatchData $dispatchData, Notification $notif)
    {
        $this->dispatchData = $dispatchData;
        $this->notif = $notif;
        $this->init();
    }

    protected function init(){}

    public function performDispatch()
    {

    }

    /**
     * @param User $receiver
     * @return TextDataContainer
     */
    protected function getTextDataContainer(User $receiver)
    {
        $receiverUid = $receiver->primaryKey;
        DispatchException::ensure(
            isset($this->dispatchData->textDataContainers[$receiverUid]),
            "Can't find TextDataContainer for uid [{$receiverUid}]"
        );

        return $this->dispatchData->textDataContainers[$receiverUid];
    }

}
