<?php
namespace app\ext\Notification\Dispatch\DataFetcher\UserRelated;

use app\ext\Notification\Dispatch\DataFetcher\DataFetcher;
use app\ext\Notification\Placeholderable\Decorator\UserDecorator;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use app\models\User;

class DataFetcherUserRelated extends DataFetcher
{
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
