<?php
namespace app\ext\Notification\Dispatch\Transport\Email;

use app\ext\Notification\Dispatch\DispatchException;
use app\ext\Notification\Dispatch\Transport\TransportBase;
use app\ext\Notification\Placeholderable\TextDataContainer;
use app\models\User;
use yii\mail\MailerInterface;

class EmailDispatcher extends TransportBase
{
    protected function init()
    {
        parent::init();
    }

    public function performDispatch()
    {
        $senderAddressee = EmailAddressee::getAddresseeByUser($this->dispatchData->sendFrom);

        /** @var MailerInterface $mailer */
        $mailer = \Yii::$app->mailer;

        /** @var User $receiver */
        foreach ($this->dispatchData->receivers as $receiver) {
            $textDataContainer = $this->getTextDataContainer($receiver);

            $receiverAddressee = EmailAddressee::getAddresseeByUser($receiver);
            $mailer->compose()
                ->setFrom([$senderAddressee->email => $senderAddressee->name])
                ->setTo($receiverAddressee->email)
                ->setSubject($textDataContainer->subject)
                ->setTextBody($textDataContainer->message)
                ->send();
        }
    }



}
