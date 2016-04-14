<?php
use app\models\Notification;
use app\models\NotificationBrowserDispatch;
use yii\bootstrap\Alert;

/**
 * @var NotificationBrowserDispatch $model
 * @var Notification $notif
 */

$notif = $model->notif;


Alert::begin([
    'options' => [
        'class' => $model->status == $model::STATUS_UNREAD ? 'alert-success' : 'alert-info',
    ],
    'closeButton' => ['data' => ['id' => $model->id], 'data-dismiss' => '', 'title' => "Пометить прочитанным"]
]); ?>

    <article class="item">
        <h4 class="title"><?= $model->subject ?> [<?=$model->id ?>]</h4>

        <ul class="nav nav-pills badges" role="tablist">
            <li role="presentation">Отправлено: <span class="badge"><?=$model->send_at ?></span></li>
            <li role="presentation" style="margin-left: 20px;">Пользователем: <span class="badge"><?=$model->sender->username ?></span></li>
        </ul>

        <br>
        <div class="message">
            <?=nl2br($model->body) ?>
        </div>
    </article>

<?php Alert::end(); ?>