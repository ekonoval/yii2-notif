<?php
namespace app\ext\Notification\Placeholderable\Decorator;

use app\models\User;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;

class UrlDecorator extends BaseDecorator
{
    protected function replacePlaceholders($text)
    {
        pa(\Yii::$app); exit;
        
        return strtr($text,
            [
                '{userName}' => $this->user->username,
                '{userId}' => $this->user->primaryKey
            ]
        );
    }

}
