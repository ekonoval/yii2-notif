<?php
namespace app\ext\Notification;

use app\ext\Notification\Dispatch\DataFetcher\ArticleRelated\DataFetcherAricleRelated;
use app\ext\Notification\Dispatch\DataFetcher\UserRelated\DataFetcherUserRelated;
use app\ext\Notification\Dispatch\DispatchData;
use app\ext\Notification\Dispatch\Transport\Email\EmailDispatcher;
use app\models\Notification;
use app\models\User;

class NfProcessor
{
    /**
     * @var Notification
     */
    private $notif;

    /**
     * @var IAbleToNotify
     */
    private $eventRaiserModel;

    /**
     * TODO - fetch it from real cross table
     * @var array
     */
    private $notifTypes = [Notification::TYPE_EMAIL];

    public function __construct(Notification $notif, IAbleToNotify $eventRaiserModel)
    {
        $this->notif = $notif;
        $this->eventRaiserModel = $eventRaiserModel;
    }

    public function process()
    {
        $sender = $this->defineSender();
        $receivers = $this->defineReceivers();

        $dispatchData = null;

        $userRelatedEvents = [Notification::EVENT_USER_BLOCKED, Notification::EVENT_USER_REGISTERED];

        //--- user related similar events ---//
        if (in_array($this->notif->code, $userRelatedEvents)) {
            $dispatchDataFetcher = new DataFetcherUserRelated($this->eventRaiserModel, $this->notif, $sender, $receivers);
            $dispatchData = $dispatchDataFetcher->prepareDispatchData();
        }
        //--- article related ---//
        elseif ($this->notif->code == Notification::EVENT_ARTICLE_CREATED) {

            $dispatchDataFetcher = new DataFetcherAricleRelated($this->eventRaiserModel, $this->notif, $sender, $receivers);
            $dispatchData = $dispatchDataFetcher->prepareDispatchData();
        }

        NfException::ensure(
            !empty($dispatchData) && $dispatchData instanceof DispatchData,
            "Invalid dispatchData for notifId [{$this->notif->primaryKey}]"
        );

        foreach ($this->notifTypes as $notifType) {
            if ($notifType == Notification::TYPE_EMAIL) {
                $emailDispatcher = new EmailDispatcher($dispatchData);
                $emailDispatcher->performDispatch();
            }
        }

    }

    private function defineSender()
    {
        /** @var User $user */
        $user = User::findOne($this->notif->sender);
        NfException::ensure(!is_null($user), "Sender not found");

        return $user;
    }

    /**
     * Returnes the list of receivers User models depending on notification receiver field
     * @return array
     */
    private function defineReceivers()
    {
        $receivers = [];
        $receiverId = $this->notif->receiver;

        // direct user
        if ($receiverId > 0) {
            /** @var User $user */
            $user = User::findOne($receiverId);
            NfException::ensure($user instanceof User, "Can't find receiver with id [{$receiverId}]");
            $receivers[$user->primaryKey] = $user;

        } elseif ($receiverId == Notification::RECEIVER_OWNER_ID) {
            NfException::ensure($this->eventRaiserModel instanceof User, "Incorrect event sender param for {$this->notif->code}");

            /** @var User $user */
            $user = $this->eventRaiserModel;
            $receivers[$user->primaryKey] = $user;

        } elseif ($receiverId == Notification::RECEIVER_ALL_ID) {
            $receivers = User::find()->indexBy(User::primaryKey()[0])->where(['status' => User::STATUS_ACTIVE])->all();
        }

        return $receivers;
    }

}
