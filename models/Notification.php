<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property integer $sender
 * @property integer $receiver
 * @property integer $enabled
 * @property string $subject
 * @property string $body
 */
class Notification extends ActiveRecord
{
    const EVENT_USER_REGISTERED = 'EVENT_USER_REGISTERED';
    const EVENT_USER_BLOCKED = 'EVENT_USER_BLOCKED';
    const EVENT_ARTICLE_CREATED = 'EVENT_ARTICLE_CREATED';

    const TYPE_EMAIL = 1;
    const TYPE_BROWSER = 2;

    const RECEIVER_ALL_ID = -1;
    const RECEIVER_OWNER_ID = -2;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'title', 'sender', 'receiver', 'subject', 'body'], 'required'],
            [['sender', 'receiver', 'enabled'], 'integer'],
            [['body'], 'string'],
            [['code'], 'string', 'max' => 100],
            [['title', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'title' => 'Title',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'enabled' => 'Enabled',
            'subject' => 'Subject',
            'body' => 'Body',
        ];
    }
}
