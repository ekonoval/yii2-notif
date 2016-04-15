<?php

namespace app\models\NotificationDecorator;

use Yii;

/**
 * This is the model class for table "notification_to_decorator".
 *
 * @property string $notif_code
 * @property integer $decorator_id
 *
 * @property NotificationDecorator $decorator
 */
class NotificationToDecorator extends \yii\db\ActiveRecord
{
    const REL_DECORATOR = 'decorator';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_to_decorator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notif_code', 'decorator_id'], 'required'],
            [['decorator_id'], 'integer'],
            [['notif_code'], 'string', 'max' => 50],
            [['notif_code', 'decorator_id'], 'unique', 'targetAttribute' => ['notif_code', 'decorator_id'], 'message' => 'The combination of Notif Code and Decorator ID has already been taken.'],
            [['decorator_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationDecorator::className(), 'targetAttribute' => ['decorator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notif_code' => 'Notif Code',
            'decorator_id' => 'Decorator ID',
        ];
    }

    /**
     * REL_DECORATOR
     * @return \yii\db\ActiveQuery
     */
    public function getDecorator()
    {
        return $this->hasOne(NotificationDecorator::className(), ['id' => 'decorator_id']);
    }
}
