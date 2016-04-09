<?php
namespace app\ext\Notification\Placeholderable\Decorator;

use app\models\User;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;

class UserDecorator extends BaseDecorator
{
    private $user;

    public function __construct(TextPlaceholderProcessor $textPlaceholderProcessor, User $user)
    {
        parent::__construct($textPlaceholderProcessor);
        $this->user = $user;
    }

    protected function replacePlaceholders($text)
    {
        return strtr($text,
            [
                '{userName}' => $this->user->username,
                '{userId}' => $this->user->primaryKey
            ]
        );
    }

}
