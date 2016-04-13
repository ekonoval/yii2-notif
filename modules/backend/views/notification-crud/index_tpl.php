<?php

use app\models\User;
use app\modules\backend\models\NotifCrud\NotifCrudSearch;
use app\modules\backend\models\UserCrud\ArticleCrudSearch;
use app\modules\backend\models\UserCrud\UserCrudSearch;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel NotifCrudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::to('/backend/notification-crud')];

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
            'code',
            'subject',
            'enabled',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
