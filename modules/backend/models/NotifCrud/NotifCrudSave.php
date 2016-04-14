<?php
namespace app\modules\backend\models\NotifCrud;

use app\models\Notification;
use yii\data\ActiveDataProvider;

/**
 * {@inheritdoc}
 */
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

    public function beforeValidate()
    {
//        pa($this); exit;
        return parent::beforeValidate();
    }


    public function beforeSave($insert)
    {
        pa('before save');
        pa($this);
        pa("exit"); exit;
        return parent::beforeSave($insert);
    }


    public function afterSave($insert, $changedAttributes)
    {
        //pa($this->typeIdsRelated);exit;
        parent::afterSave($insert, $changedAttributes);
    }


}
