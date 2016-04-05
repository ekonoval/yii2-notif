<?php

use app\models\User;
use app\modules\backend\models\UserCrud\UserCrudSearch;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel UserCrudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users-Crud';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::to('/backend/user-crud')];

?>

<div class="users-list">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            'username',
            'email',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return User::getStatusName($data->status);
                },
                'filter' => User::statusesList()
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
