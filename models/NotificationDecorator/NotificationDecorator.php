<?php

namespace app\models\NotificationDecorator;

use Yii;

/**
 * This is the model class for table "notification_decorator".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $enabled
 *
 * @property NotificationDecoratorTag[] $NotificationDecoratorTag
 * @property NotificationToDecorator[] $notificationToDecorators
 */
class NotificationDecorator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_decorator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['enabled'], 'integer'],
            [['slug'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'enabled' => 'Enabled',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationDecoratorTag()
    {
        return $this->hasMany(NotificationDecoratorTag::className(), ['decorator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationToDecorators()
    {
        return $this->hasMany(NotificationToDecorator::className(), ['decorator_id' => 'id']);
    }
}
