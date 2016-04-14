<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification_browser_dispatch".
 *
 * @property integer $id
 * @property integer $notif_id
 * @property integer $receiver_id
 * @property integer $sender_id
 * @property integer $status
 * @property string $send_at
 * @property string $subject
 * @property string $body
 *
 * @property User $sender
 * @property Notification $notif
 * @property User $receiver
 */
class NotificationBrowserDispatch extends ActiveRecord
{
    const STATUS_UNREAD = 1;
    const STATUS_READ = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_browser_dispatch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notif_id', 'receiver_id', 'sender_id', 'status', 'subject', 'body'], 'required'],
            [['notif_id', 'receiver_id', 'sender_id', 'status'], 'integer'],
            [['send_at'], 'safe'],
            [['body'], 'string'],
            [['subject'], 'string', 'max' => 255],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['notif_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::className(), 'targetAttribute' => ['notif_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notif_id' => 'Notif ID',
            'receiver_id' => 'Receiver ID',
            'sender_id' => 'Sender ID',
            'status' => 'Status',
            'send_at' => 'Send At',
            'subject' => 'Subject',
            'body' => 'Body',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotif()
    {
        return $this->hasOne(Notification::className(), ['id' => 'notif_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }
}
