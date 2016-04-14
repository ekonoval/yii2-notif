<?php
namespace app\ext\Notification\Placeholderable\Decorator;

class SiteDecorator extends BaseDecorator
{
    protected function replacePlaceholders($text)
    {
        return strtr($text,
            [
                '{siteName}' => $_SERVER['HTTP_HOST'],
                '{siteUrl}' => \Yii::$app->urlManager->createAbsoluteUrl('/'),
            ]
        );
    }

}
