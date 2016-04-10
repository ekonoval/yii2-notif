<?php

namespace app\models;

use app\ext\Notification\IAbleToNotify;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $short_text
 * @property integer $full_text
 * @property integer $enabled
 */
class Article extends ActiveRecord implements IAbleToNotify
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'title',], 'required'],
            [['author_id'], 'integer'],
            [['enabled'], 'boolean'],
            [['short_text', 'full_text'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'title' => 'Title',
            'short_text' => 'Short Text',
            'full_text' => 'Full Text',
            'enabled' => 'Enabled',
        ];
    }
}
