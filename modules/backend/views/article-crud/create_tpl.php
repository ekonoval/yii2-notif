<?php

use app\modules\backend\models\ArticleCrud\ArticleCrudSave;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model ArticleCrudSave */

$this->title = 'Create Admin';
$this->params['breadcrumbs'][] = ['label' => 'Articles List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
