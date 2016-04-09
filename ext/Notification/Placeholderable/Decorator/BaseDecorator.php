<?php
namespace ext\Notification\Placeholderable\Decorator;

use app\ext\Notification\Placeholderable\Decorator\ITextPlaceholderDecorator;
use app\models\Notification;
use ext\Notification\Placeholderable\TextDataContainer;
use ext\Notification\Placeholderable\TextPlaceholderProcessor;

abstract class BaseDecorator implements ITextPlaceholderDecorator
{
    /**
     * @var TextPlaceholderProcessor
     */
    protected $textPlaceholderProcessor;

    /**
     * @var TextDataContainer
     */
    protected $textDataContainer;

    public function __construct(TextPlaceholderProcessor $textPlaceholderProcessor)
    {
        $this->textPlaceholderProcessor = $textPlaceholderProcessor;
        $this->notif = $textPlaceholderProcessor->getNotif();
        $this->textDataContainer = $textPlaceholderProcessor->getTextDataContainer();
    }

    public function prepareTextData()
    {
        $this->textDataContainer->message = $this->replacePlaceholders($this->textDataContainer->message);
        $this->textDataContainer->subject = $this->replacePlaceholders($this->textDataContainer->subject);
    }

    /**
     * @param $text
     * @return string
     */
    abstract protected function replacePlaceholders($text);

}
