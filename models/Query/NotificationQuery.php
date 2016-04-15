<?php
namespace app\models\Query;

use yii\db\ActiveQuery;


class NotificationQuery extends ActiveQuery
{
    public function enabled()
    {
        return $this->andWhere(['enabled' => 1]);
    }
}
