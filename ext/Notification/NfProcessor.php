<?php
namespace app\ext\Notification;

use app\ext\Notification\Dispatch\DataFetcher\ArticleRelated\DataFetcherAricleRelated;
use app\ext\Notification\Dispatch\DataFetcher\UserRelated\DataFetcherUserRelated;
use app\ext\Notification\Dispatch\DispatchData;
use app\ext\Notification\Dispatch\Transport\Browser\BrowserDispatcher;
use app\ext\Notification\Dispatch\Transport\Email\EmailDispatcher;
use app\models\Notification;
use app\models\User;

/**
 * Processes and dispatches single notification
 */
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
     * @var array
     */
    private $notifTypes;

    /**
     * @var User
     */
    private $sender;

    /**
     * @var User[]
     */
    private $receivers = [];

    /**
     * @var DispatchData
     */
    private $dispatchData;

    public function __construct(Notification $notif, IAbleToNotify $eventRaiserModel)
    {
        $this->notif = $notif;
        $this->notifTypes = $this->notif->getTypeIdsRelated();
        $this->eventRaiserModel = $eventRaiserModel;
    }

    public function process()
    {
        $this->defineSender();
        $this->defineReceivers();

        $this->composeDispatchData();

        //--- perform all dispatches types ---//
        foreach ($this->notifTypes as $notifType) {
            if ($notifType == Notification::TYPE_EMAIL) {
                $emailDispatcher = new EmailDispatcher($this->dispatchData, $this->notif);
                $emailDispatcher->performDispatch();
            } elseif ($notifType == Notification::TYPE_BROWSER) {
                $browserDispatcher = new BrowserDispatcher($this->dispatchData, $this->notif);
                $browserDispatcher->performDispatch();
            }
        }
    }

    private function composeDispatchData()
    {
        $userRelatedEvents = [Notification::EVENT_USER_BLOCKED, Notification::EVENT_USER_REGISTERED];
        //--- user related similar events ---//
        if (in_array($this->notif->code, $userRelatedEvents)) {
            $dispatchDataFetcher = new DataFetcherUserRelated($this->eventRaiserModel, $this->notif, $this->sender, $this->receivers);
            $this->dispatchData = $dispatchDataFetcher->prepareDispatchData();
        }
        //--- article related ---//
        elseif ($this->notif->code == Notification::EVENT_ARTICLE_CREATED) {
            $dispatchDataFetcher = new DataFetcherAricleRelated($this->eventRaiserModel, $this->notif, $this->sender, $this->receivers);
            $this->dispatchData = $dispatchDataFetcher->prepareDispatchData();
        }

        NfException::ensure(
            !empty($this->dispatchData) && $this->dispatchData instanceof DispatchData,
            "Invalid dispatchData for notifId [{$this->notif->primaryKey}]"
        );
    }

    private function defineSender()
    {
        /** @var User $user */
        $this->sender = User::findOne($this->notif->sender);
        NfException::ensure(!is_null($this->sender), "Sender not found");
    }

    /**
     * Returnes the list of receivers User models depending on notification receiver field
     * @return array
     */
    private function defineReceivers()
    {
        $receiverId = $this->notif->receiver;

        // direct user
        if ($receiverId > 0) {
            /** @var User $user */
            $user = User::findOne($receiverId);
            NfException::ensure($user instanceof User, "Can't find receiver with id [{$receiverId}]");
            $this->receivers[$user->primaryKey] = $user;

        } elseif ($receiverId == Notification::RECEIVER_OWNER_ID) {
            NfException::ensure($this->eventRaiserModel instanceof User, "Incorrect event sender param for {$this->notif->code}");

            /** @var User $user */
            $user = $this->eventRaiserModel;
            $this->receivers[$user->primaryKey] = $user;

        } elseif ($receiverId == Notification::RECEIVER_ALL_ID) {
            $this->receivers = User::find()
                ->indexBy('id')
                ->selectLight()
                ->where(['status' => User::STATUS_ACTIVE])
                ->all()
            ;
        }
    }

}
