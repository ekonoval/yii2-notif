<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
 *
 * @property array $types
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

    public function getTypes()
    {
        return $this->hasMany(NotificationToType::class, ['notif_id' => 'id'])->indexBy('type');
    }

    public function getTypeIdsRelated()
    {
        return ArrayHelper::map($this->types, 'type', 'type');
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

    /**
     * @return NotificationQuery
     */
    public static function find()
    {
        return new NotificationQuery(get_called_class());
    }

    public static function getEventsList()
    {
        return [
            self::EVENT_USER_REGISTERED => "регистрация юзера",
            self::EVENT_USER_BLOCKED => "блокировка юзера",
            self::EVENT_ARTICLE_CREATED => "статья создана",
        ];
    }

    public static function getEventName($code)
    {
        static $events;
        if (!$events) {
            $events = self::getEventsList();
        }

        return array_key_exists($code, $events) ? $events[$code] : '-error-';
    }

    public static function getTypeNamesAvailable()
    {
        return [
            self::TYPE_EMAIL => 'email',
            self::TYPE_BROWSER => 'браузер',
        ];
    }

    public static function getReceiversAvailable()
    {
        $receivers = [
            self::RECEIVER_OWNER_ID => '-владелец-',
            self::RECEIVER_ALL_ID => '-все-',
        ];

        $users = User::getUserOptions();

        return $receivers + $users;
    }

    public static function getSendersAvailable()
    {
        return User::getUserOptions();
    }

}
