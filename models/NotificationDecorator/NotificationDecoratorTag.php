<?php

namespace app\models\NotificationDecorator;

use Yii;

/**
 * This is the model class for table "notification_decorator_tag".
 *
 * @property integer $id
 * @property integer $decorator_id
 * @property string $tag
 *
 * @property NotificationDecorator $decorator
 */
class NotificationDecoratorTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_decorator_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['decorator_id', 'tag'], 'required'],
            [['decorator_id'], 'integer'],
            [['tag'], 'string', 'max' => 50],
            [['tag'], 'unique'],
            [['decorator_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationDecorator::className(), 'targetAttribute' => ['decorator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'decorator_id' => 'Decorator ID',
            'tag' => 'Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecorator()
    {
        return $this->hasOne(NotificationDecorator::className(), ['id' => 'decorator_id']);
    }
}
