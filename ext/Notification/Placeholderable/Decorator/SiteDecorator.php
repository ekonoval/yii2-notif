<?php
namespace app\ext\Notification\Placeholderable\Decorator;

use app\models\User;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;

class SiteDecorator extends BaseDecorator
{
    protected function replacePlaceholders($text)
    {
        return strtr($text,
            [
                '{siteName}' => $_SERVER['HTTP_HOST'],
            ]
        );
    }

}
