<?php
namespace app\modules\backend\models\ArticleCrud;

use app\ext\Notification\NfBehavior;
use app\models\Article;
use app\models\Notification;

class ArticleCrudSave extends Article
{
    public function init()
    {
        parent::init();
        $this->attachBehavior(NfBehavior::NAME, NfBehavior::class);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $this->trigger(Notification::EVENT_ARTICLE_CREATED);
        }
    }


}
