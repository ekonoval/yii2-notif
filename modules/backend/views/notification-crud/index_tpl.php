<?php

use app\ext\Grid\BooleanColumn;
use app\models\Notification;
use app\modules\backend\models\NotifCrud\NotifCrudSearch;
use app\modules\backend\models\UserCrud\ArticleCrudSearch;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel NotifCrudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::to('/backend/notification-crud')];

$receiversAll = $searchModel->getReceiversAvailable();

$sendersAll = array_filter($receiversAll, function($key){
        return !in_array($key, [Notification::RECEIVER_OWNER_ID, Notification::RECEIVER_ALL_ID]);
    },
    ARRAY_FILTER_USE_KEY
);
?>

<div class="users-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Notification', ['create'], ['class' => 'btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'admin-crud-id', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
            ],
            'id',
            'title',
            [
                'attribute' => 'code',
                'value' => function ($data) use ($searchModel) {
                    return $searchModel::getEventName($data->code);
                },
                'filter' => $searchModel::getEventsList()
            ],
            [
                'attribute' => 'sender',
                'value' => function ($data) use ($searchModel, $sendersAll) {
                    return array_key_exists($data->sender, $sendersAll) ? $sendersAll[$data->sender] : 'err';
                },
                'filter' => $sendersAll
            ],
            [
                'attribute' => 'receiver',
                'value' => function ($data) use ($searchModel, $receiversAll) {
                    return array_key_exists($data->receiver, $receiversAll) ? $receiversAll[$data->receiver] : 'err';
                },
                'filter' => $receiversAll
            ],
            'subject',
            [
                'attribute' => 'enabled',
                'class' => BooleanColumn::className(),
                //'filterInputOptions' => ['class' => 'form-control']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
