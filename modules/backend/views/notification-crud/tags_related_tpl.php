<?php
use app\models\NotificationDecorator\NotificationToDecorator;
use yii\helpers\Html;

/**
 * @var NotificationToDecorator  $model
 */

if (!$tags) {
    return '';
}
?>

<div class="sing">Possible placeholders:</div>

<ul>
<?php
foreach($tags as $model) {
    foreach ($model->decorator->notificationDecoratorTag as $tag) {
        echo Html::tag('li', "{{$tag->tag}}");
    }
}
?>
</ul>

