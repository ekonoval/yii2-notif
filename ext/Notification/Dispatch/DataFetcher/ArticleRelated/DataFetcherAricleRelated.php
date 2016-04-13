<?php
namespace app\ext\Notification\Dispatch\DataFetcher\ArticleRelated;

use app\ext\Notification\Dispatch\DataFetcher\DataFetcher;
use app\ext\Notification\Placeholderable\Decorator\ArticleDecorator;
use app\ext\Notification\Placeholderable\Decorator\UserDecorator;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use app\models\User;

class DataFetcherAricleRelated extends DataFetcher
{
    public function prepareDispatchData()
    {
        /** @var User $receiver */
        foreach ($this->userReceiversList as $receiver) {

            $textPlaceholderProcessor = new TextPlaceholderProcessor($this->notif);
            $textPlaceholderProcessor->prepareTextData();

            $userDecorator = new UserDecorator($textPlaceholderProcessor, $receiver);
            $userDecorator->prepareTextData();

            $articleDecorator = new ArticleDecorator($textPlaceholderProcessor, $this->eventRaiserModel);
            $articleDecorator->prepareTextData();

            $textDataContainer = $textPlaceholderProcessor->getTextDataContainer();

            $this->dispatchData->textDataContainers[$receiver->primaryKey] = $textDataContainer;
        }

        return $this->dispatchData;
    }
}
