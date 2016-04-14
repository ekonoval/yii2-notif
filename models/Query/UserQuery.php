<?php
namespace app\models\Query;

use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function selectLight()
    {
        return $this->select(['id', 'username', 'email', 'status']);
    }
}
