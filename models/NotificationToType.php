<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification_to_type".
 *
 * @property integer $notif_id
 * @property integer $type
 *
 * @property Notification $notif
 */
class NotificationToType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_to_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notif_id', 'type'], 'required'],
            [['notif_id', 'type'], 'integer'],
            [['notif_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::className(), 'targetAttribute' => ['notif_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notif_id' => 'Notif ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotif()
    {
        return $this->hasOne(Notification::className(), ['id' => 'notif_id']);
    }
}
