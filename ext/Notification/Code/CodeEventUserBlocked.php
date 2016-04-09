<?php
namespace app\ext\Notification\Code;

use app\ext\Notification\Placeholderable\Decorator\UserDecorator;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use app\models\Notification;
use app\models\User;

class CodeEventUserBlocked
{
    private $notif;
    private $userSendFrom;
    private $userReceiversList;

    private $dispatchData;

    public function __construct(Notification $notification, User $userSendFrom, $userReceiversList)
    {
        $this->notif = $notification;
        $this->userSendFrom = $userSendFrom;
        $this->userReceiversList = $userReceiversList;
    }

    public function prepareDispatchData()
    {
        $this->dispatchData = [
            'sendFrom' => $this->userSendFrom,
            'receivers' => $this->userReceiversList,
            'textDataContainers' => []
        ];

        /** @var User $receiver */
        foreach ($this->userReceiversList as $receiver) {

            $textPlaceholderProcessor = new TextPlaceholderProcessor($this->notif);
            $textPlaceholderProcessor->prepareTextData();

            $userDecorator = new UserDecorator($textPlaceholderProcessor, $receiver);
            $userDecorator->prepareTextData();

            $textDataContainer = $textPlaceholderProcessor->getTextDataContainer();

            $this->dispatchData['textDataContainers'][$receiver->primaryKey] = $textDataContainer;

        }
    }
}
