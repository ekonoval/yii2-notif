<?php

use app\modules\backend\models\NotifCrud\NotifCrudSave;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model NotifCrudSave */

$this->title = 'Notification';
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
