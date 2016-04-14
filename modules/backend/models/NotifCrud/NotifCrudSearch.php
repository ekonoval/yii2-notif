<?php
namespace app\modules\backend\models\NotifCrud;

use app\models\Notification;
use yii\data\ActiveDataProvider;

class NotifCrudSearch extends Notification
{
    public function rules()
    {
        return [
            [['code', 'title', 'subject', 'enabled'], 'safe'],
            [['sender', 'receiver', 'enabled'], 'integer'],
        ];
    }


    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 2
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'subject', $this->subject]);

        return $dataProvider;
    }
}
