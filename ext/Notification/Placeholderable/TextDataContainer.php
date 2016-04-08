<?php
namespace ext\Notification\Placeholderable;

class TextDataContainer
{
    public $message;
    public $subject;

    public function __construct($subject, $message)
    {
        $this->message = $message;
        $this->subject = $subject;
    }

}
