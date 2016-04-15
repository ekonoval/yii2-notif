<?php
namespace app\modules\backend\models\NotifCrud;

use app\models\NotificationDecorator\NotificationDecorator;
use app\models\NotificationDecorator\NotificationDecoratorTag;
use app\models\NotificationDecorator\NotificationToDecorator;
use Yii;
use yii\db\Query;

/**
 * Just a model to play with different join options
 */
class NotifTagsRelated
{
    private $eventCode;

    public function __construct($eventCode)
    {
        $this->eventCode = $eventCode;
    }

    public function getTagsRelated()
    {
        //$this->daoWay();

        return $this->activeRecordWay();
    }

    private function daoWay()
    {
        $sql = "
            SELECT t.id, t.decorator_id, t.tag
            FROM " . NotificationToDecorator::tableName() . " n2d
                INNER JOIN " . NotificationDecorator::tableName() . " d
                    ON d.id = n2d.decorator_id
                INNER JOIN `" . NotificationDecoratorTag::tableName() . "` t
                    ON t.decorator_id = d.id
            WHERE
                n2d.notif_code = :notifCode
            ORDER BY
                t.decorator_id, t.tag
        ";

        $res = Yii::$app->db->createCommand($sql, [':notifCode' => $this->eventCode])->queryAll();
        return $res;
    }

    private function activeRecordWay()
    {
        //$model = $this->arWay1();

        $model = $this->arWay2();

        return $model;
    }

    private function arWay2()
    {
        /** @var NotificationToDecorator $model */
        $model = NotificationToDecorator::find()
            ->innerJoinWith([
                NotificationToDecorator::REL_DECORATOR => function (Query $query) {
                    $query->andWhere(['d.enabled' => 1]);

                    $query->from(['d' => 'notification_decorator']);
                    $query->select('d.id, d.slug, d.enabled');
                    //$query->select('notification_decorator.id, notification_decorator.enabled');
                },
            ], true)
            ->innerJoinWith([
                NotificationToDecorator::REL_DECORATOR,
                NotificationToDecorator::REL_DECORATOR . '.' . NotificationDecorator::REL_TAG => function (Query $query) {
                    $query->from(['dt' => NotificationDecoratorTag::tableName()]);
                    $query->select('dt.id, dt.decorator_id, dt.tag');
                }
            ], true)
            ->where(['notif_code' => $this->eventCode])
            //->select('dt.id, dt.decorator_id, dt.tag')
            //->indexBy('decorator_id')
            ->orderBy('dt.decorator_id, dt.tag ASC')
            //->asArray()
            ->all();

        return $model;
    }

    private function arWay1()
    {
        /** @var NotificationToDecorator $model */
        $model = NotificationToDecorator::find()
            ->innerJoinWith([
                NotificationToDecorator::REL_DECORATOR => function (Query $query) {
                    $query->andWhere(['enabled' => 1]);
                },
            ], false)
            ->innerJoinWith([
                NotificationToDecorator::REL_DECORATOR,
                NotificationToDecorator::REL_DECORATOR . '.' . NotificationDecorator::REL_TAG => function (Query $query) {
                    $query->from(['dt' => NotificationDecoratorTag::tableName()]);
                }
            ], false)
            ->where(['notif_code' => $this->eventCode])
            ->select('dt.id, dt.decorator_id, dt.tag')
            //->indexBy('decorator_id')
            ->orderBy('dt.decorator_id, dt.tag ASC')
            ->asArray()
            ->all();

        return $model;
    }
}
