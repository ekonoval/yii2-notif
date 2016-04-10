<?php
namespace app\ext\Notification\Type;

use app\models\Notification;
use app\models\User;
use app\ext\Notification\Placeholderable\Decorator\UserDecorator;
use app\ext\Notification\Placeholderable\TextPlaceholderProcessor;
use Yii;

/**
 * @deprecated
 */
class NfEmailTypeProcessor
{
    private $notif;
    private $userSendFrom;
    private $userReceiversList;

    public function __construct(Notification $notification, User $userSendFrom, $userReceiversList)
    {
        $this->notif = $notification;
        $this->userSendFrom = $userSendFrom;
        $this->userReceiversList = $userReceiversList;
    }

    public function prepareDispatchData()
    {
        $mailer = Yii::$app->mailer;

        /** @var User $receiver */
        foreach ($this->userReceiversList as $receiver) {

            $textPlaceholderProcessor = new TextPlaceholderProcessor($this->notif);
            $textPlaceholderProcessor->prepareTextData();

            $userDecorator = new UserDecorator($textPlaceholderProcessor, $receiver);
            $userDecorator->prepareTextData();

            $textDataContainer = $textPlaceholderProcessor->getTextDataContainer();
            pa($textDataContainer);exit;

//            $mailer->compose()
//                ->setFrom([$this->userSendFrom->email => $this->userSendFrom->username])
//                ->setTo('to@domain.com')
//                ->setSubject('Message subject')
//                ->setTextBody('Plain text content')
//                ->send();
        }
    }

    private function getMessagePrepared()
    {
        return $this->notif->body;
    }

    private function getSubjectPrepared()
    {
        return $this->notif->subject;
    }


}
