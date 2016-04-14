<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cabinet">

    <?php
    Pjax::begin(['id' => 'cabinet-msgs', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]);

    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{pager}\n{items}\n{summary}",
        'itemView' => 'cabinet_list_item_tpl',
    ]);

    Pjax::end();
    ?>

</div>
