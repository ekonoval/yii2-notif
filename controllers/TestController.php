<?php

namespace app\controllers;

use app\ext\Notification\NfProcessorMulti;
use app\models\Article;
use app\models\Notification;
use app\models\NotificationDecorator\NotificationDecorator;
use app\models\NotificationDecorator\NotificationDecoratorTag;
use app\models\NotificationDecorator\NotificationToDecorator;
use app\models\User;
use Yii;
use yii\db\Command;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Response;

class TestController extends Controller
{

    public function actionIndex()
    {
        $eventType = Notification::EVENT_USER_BLOCKED;
//        $eventType = Notification::EVENT_USER_REGISTERED;
        $raiser = User::findOne(1);

        $eventType = Notification::EVENT_ARTICLE_CREATED; $raiser = Article::findOne(2);

        $nfProcessor = new NfProcessorMulti();
        $nfProcessor->processEventType($eventType, $raiser);

        pa('done'); exit;

        return new Response();
    }

    public function actionJunction()
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
                NotificationToDecorator::REL_DECORATOR.'.'.NotificationDecorator::REL_TAG => function(Query $query){
                    $query->from(['dt' => NotificationDecoratorTag::tableName()]);
                }
            ], false)
            ->where(['notif_code' => Notification::EVENT_USER_BLOCKED])
            ->select('dt.id, dt.decorator_id, dt.tag')
            //->indexBy('decorator_id')
            ->orderBy('dt.decorator_id, dt.tag ASC')
            ->asArray()
            ->all();

        //pa($model);

        $sql = "
            SELECT t.id, t.decorator_id, t.tag
            FROM ".NotificationToDecorator::tableName()." n2d
                INNER JOIN ".NotificationDecorator::tableName()." d
                    ON d.id = n2d.decorator_id
                INNER JOIN `".NotificationDecoratorTag::tableName()."` t
                    ON t.decorator_id = d.id
            WHERE
                n2d.notif_code = :notifCode
            ORDER BY
                t.decorator_id, t.tag
        ";

        /** @var Command $cmd */
        $cmd = Yii::$app->db->createCommand($sql, [':notifCode' => Notification::EVENT_USER_BLOCKED]);
        $res = $cmd->queryAll();

        pa($res);

        //return new Response('<html><body></body></html>');
        return $this->renderContent("fake");
    }

}
