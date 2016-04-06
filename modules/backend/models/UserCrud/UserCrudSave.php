<?php
namespace app\modules\backend\models\UserCrud;

use app\ext\User\UserIdentity;
use app\models\User;
use ext\Notification\Notification;
use yii\base\Event;

class UserCrudSave extends User
{
    private $oldStatus;

    public function afterFind()
    {
        parent::afterFind();

        $this->oldStatus = $this->status;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->status == UserIdentity::STATUS_BLOCKED && $this->oldStatus != $this->status) {
            $this->trigger(Notification::EVENT_USER_BLOCKED);
        }
    }


}
