<?php
namespace app\modules\backend\models\UserCrud;

use app\ext\User\UserIdentity;
use app\models\Notification;
use app\models\User;
use app\ext\Notification\NfBehavior;

class UserCrudSave extends User
{
    private $oldStatus;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => NfBehavior::class
        ];

        return $behaviors;
    }


    public function afterFind()
    {
        parent::afterFind();

        $this->oldStatus = $this->status;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->trigger(Notification::EVENT_USER_BLOCKED);

        if ($this->status == UserIdentity::STATUS_BLOCKED && $this->oldStatus != $this->status) {
//            $this->trigger(Notification::EVENT_USER_BLOCKED);
        }
    }


}
