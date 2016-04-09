<?php
namespace app\ext\Notification\Placeholderable;

use app\ext\Notification\Placeholderable\Decorator\ITextPlaceholderDecorator;
use app\models\Notification;

class TextPlaceholderProcessor implements ITextPlaceholderDecorator
{
    /**
     * @var Notification
     */
    protected $notif;

    /**
     * @var TextDataContainer
     */
    protected $textDataContainer;

    public function __construct(Notification $notif)
    {
        $this->notif = $notif;
    }

    public function prepareTextData()
    {
        $this->textDataContainer = new TextDataContainer($this->notif->subject, $this->notif->body);
    }

    /**
     * @return TextDataContainer
     */
    public function getTextDataContainer()
    {
        return $this->textDataContainer;
    }

    /**
     * @return Notification
     */
    public function getNotif()
    {
        return $this->notif;
    }


}
