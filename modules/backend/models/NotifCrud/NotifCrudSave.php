<?php
namespace app\modules\backend\models\NotifCrud;

use app\models\Notification;
use app\models\NotificationToType;

class NotifCrudSave extends Notification
{
    public $typeIdsRelated;

    public function rules()
    {
        $rules = parent::rules();

        $allowedTypes = array_keys(self::getTypeNamesAvailable());

        /**
         * @see http://stackoverflow.com/a/36614660/1101589
         */
        $rules[] = ['typeIdsRelated', 'required'];
        $rules[] = ['typeIdsRelated', 'in', 'allowArray' => true,  'range' => $allowedTypes ];

        return $rules;
    }

    public function attributeLabels()
    {
        $labels =  parent::attributeLabels();
        $labels['typeIdsRelated'] = 'Types';

        return $labels;
    }


    /**
     * Wrap save operations in transactions
     * @return array
     */
    public function transactions()
    {
        $transes = parent::transactions();
        $transes[$this->scenario] = self::OP_ALL;

        return $transes;
    }

    public function afterFind()
    {
        parent::afterFind();

        //--- preload selected types on edit ---//
        if (!$this->isNewRecord) {
            $this->typeIdsRelated = $this->getTypeIdsRelated();
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        NotificationToType::deleteAll(['notif_id' => $this->id]);

        foreach ($this->typeIdsRelated as $typeId) {
            $junction = new NotificationToType();
            $junction->notif_id = $this->id;
            $junction->type = $typeId;
            $junction->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }


}
