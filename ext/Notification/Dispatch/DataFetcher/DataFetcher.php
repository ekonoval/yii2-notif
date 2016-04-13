<?php
namespace app\ext\Notification\Dispatch\DataFetcher;

use app\ext\Notification\Dispatch\DispatchData;
use app\ext\Notification\Dispatch\DispatchException;
use app\ext\Notification\IAbleToNotify;
use app\ext\Notification\Placeholderable\Decorator\UserDecorator;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use app\models\Notification;
use app\models\User;

abstract class DataFetcher
{
    /**
     * @var Notification
     */
    protected $notif;

    /**
     * @var User
     */
    protected $userSendFrom;

    /**
     * Array of User models
     * @var array
     */
    protected $userReceiversList;

    /**
     * @var IAbleToNotify
     */
    protected $eventRaiserModel;

    /**
     * @var DispatchData
     */
    protected $dispatchData;

    /**
     * CodeEventUserBlocked constructor.
     * @param $eventRaiserModel
     * @param Notification $notification
     * @param User $userSendFrom
     * @param $userReceiversList
     */
    public function __construct(IAbleToNotify $eventRaiserModel, Notification $notification, User $userSendFrom, $userReceiversList)
    {
        $this->notif = $notification;
        $this->userSendFrom = $userSendFrom;
        $this->userReceiversList = $userReceiversList;
        $this->eventRaiserModel = $eventRaiserModel;

        DispatchException::ensure(!empty($userReceiversList), "\$userReceiversList is empty");

        $this->dispatchData = new DispatchData($userSendFrom, $userReceiversList);
    }

    /**
     * @return DispatchData
     */
    abstract public function prepareDispatchData();
//    {
//        /** @var User $receiver */
//        foreach ($this->userReceiversList as $receiver) {
//
//            $textPlaceholderProcessor = new TextPlaceholderProcessor($this->notif);
//            $textPlaceholderProcessor->prepareTextData();
//
//            $userDecorator = new UserDecorator($textPlaceholderProcessor, $this->eventRaiserModel);
//            $userDecorator->prepareTextData();
//
//            $textDataContainer = $textPlaceholderProcessor->getTextDataContainer();
//
//            $this->dispatchData->textDataContainers[$receiver->primaryKey] = $textDataContainer;
//        }
//
//        return $this->dispatchData;
//    }
}
