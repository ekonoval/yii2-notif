<?php
namespace ext\Notification\Placeholderable\Decorator;

class UserDecorator extends BaseDecorator
{
    public function prepareTextData()
    {

    }

    private function replacePlaceholders($text)
    {
        return strtr($text,
            [
                '{userName}' => 
            ]
        );
    }

}
