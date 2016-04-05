<?php
namespace app\modules\backend\models\ArticleCrud;

use app\models\Article;
use yii\data\ActiveDataProvider;

class ArticleCrudSearch extends Article
{
//    public function rules()
//    {
//        return [
//            [['id', 'status'], 'integer'],
//            [['username', 'email'], 'safe'],
//        ];
//    }

    public function search($params)
    {
        $query = self::find();

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
            'enabled' => $this->enabled,
        ]);

        //$createdAtMysql = DateHelper::convertJqDatePickerDate2MysqlDate($this->created_at, false);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
