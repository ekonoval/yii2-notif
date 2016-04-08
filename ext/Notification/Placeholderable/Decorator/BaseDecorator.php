<?php
namespace ext\Notification\Placeholderable\Decorator;

use app\models\Notification;
use ext\Notification\Placeholderable\TextPlaceholderProcessor;

abstract class BaseDecorator extends TextPlaceholderProcessor
{
    protected $textPlaceholderProcessor;

    public function __construct(TextPlaceholderProcessor $textPlaceholderProcessor)
    {
        $this->textPlaceholderProcessor = $textPlaceholderProcessor;
        $this->notif = $textPlaceholderProcessor->getNotif();
    }

    public function prepareTextData(){}



}
