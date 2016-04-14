<?php
namespace app\ext\Notification\Dispatch\Transport\Browser;

use app\ext\Notification\Dispatch\Transport\TransportBase;
use app\models\NotificationBrowserDispatch;
use app\models\User;

class BrowserDispatcher extends TransportBase
{
    protected $rows;
    
    public function performDispatch()
    {
        /** @var User $receiver */
        foreach ($this->dispatchData->receivers as $receiver) {
            $textDataContainer = $this->getTextDataContainer($receiver);

            $nbd = new NotificationBrowserDispatch();
            $nbd->notif_id = $this->notif->primaryKey;
            $nbd->receiver_id = $receiver->id;
            $nbd->sender_id = $this->dispatchData->sendFrom->primaryKey;
            $nbd->status = NotificationBrowserDispatch::STATUS_UNREAD;

            $nbd->subject = $textDataContainer->subject;
            $nbd->body = $textDataContainer->message;

            //$nbd->save();
            $this->rows[] = $nbd->attributes;
            
            unset($nbd);
        }

        $this->batchInsert();
    }

    /**
     * @see http://stackoverflow.com/a/27356763/1101589
     * @return bool
     */
    protected function batchInsert()
    {
        if (empty($this->rows)) {
            return false;
        }

        $model = new NotificationBrowserDispatch();
        \Yii::$app->db->createCommand()
            ->batchInsert(
                $model::tableName(),
                $model->attributes(),
                $this->rows
            )
            ->execute();

        return true;
    }

}
