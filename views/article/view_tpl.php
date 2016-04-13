<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $article Article */

use app\models\Article;
use yii\helpers\Html;

$this->title = $article->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="text-short">
        <?=$article->short_text ?>
    </div>

    <div class="text-full">
        <?=$article->full_text ?>
    </div>

</div>
