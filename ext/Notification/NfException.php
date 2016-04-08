<?php
namespace ext\Notification;

use yii\base\Exception;

class NfException extends Exception
{
    public static function ensure($expr, $failMsg = "")
    {
        if (!$expr) {
            throw new static($failMsg);
        }
    }
}
