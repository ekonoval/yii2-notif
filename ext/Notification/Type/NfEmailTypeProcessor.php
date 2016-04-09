<?php
namespace ext\Notification\Type;

use app\models\Notification;
use app\models\User;
use ext\Notification\Placeholderable\Decorator\UserDecorator;
use ext\Notification\Placeholderable\TextPlaceholderProcessor;
use Yii;

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

    public function preformDispatch()
    {
        $mailer = Yii::$app->mailer;

        /** @var User $receiver */
        foreach ($this->userReceiversList as $receiver) {

            $textPlaceholderProcessor = new TextPlaceholderProcessor($this->notif);
            $textPlaceholderProcessor->prepareTextData();

            $userDecorator = new UserDecorator($textPlaceholderProcessor, $receiver);
            $userDecorator->prepareTextData();


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
