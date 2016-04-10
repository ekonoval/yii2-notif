<?php
namespace app\ext\Notification\Code;

use app\ext\Notification\Dispatch\DispatchData;
use app\ext\Notification\Placeholderable\Decorator\UserDecorator;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use app\models\Notification;
use app\models\User;

class CodeEventUserBlocked
{
    private $notif;
    private $userSendFrom;
    private $userReceiversList;

    private $eventRaiserModel;

    private $dispatchData;

    /**
     * CodeEventUserBlocked constructor.
     * @param $eventRaiserModel
     * @param Notification $notification
     * @param User $userSendFrom
     * @param $userReceiversList
     */
    public function __construct($eventRaiserModel, Notification $notification, User $userSendFrom, $userReceiversList)
    {
        $this->notif = $notification;
        $this->userSendFrom = $userSendFrom;
        $this->userReceiversList = $userReceiversList;
        $this->eventRaiserModel = $eventRaiserModel;

        $this->dispatchData = new DispatchData($userSendFrom, $userReceiversList);
    }

    /**
     * @return DispatchData
     */
    public function prepareDispatchData()
    {

        /** @var User $receiver */
        foreach ($this->userReceiversList as $receiver) {

            $textPlaceholderProcessor = new TextPlaceholderProcessor($this->notif);
            $textPlaceholderProcessor->prepareTextData();

            $userDecorator = new UserDecorator($textPlaceholderProcessor, $this->eventRaiserModel);
            $userDecorator->prepareTextData();

            $textDataContainer = $textPlaceholderProcessor->getTextDataContainer();

            $this->dispatchData->textDataContainers[$receiver->primaryKey] = $textDataContainer;
        }

        return $this->dispatchData;
    }
}
