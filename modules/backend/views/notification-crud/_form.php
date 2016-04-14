<?php

use app\models\Notification;
use app\modules\backend\models\NotifCrud\NotifCrudSave;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model NotifCrudSave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php //pa($model->getTypesDropdownOptions()); ?>
    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'code')->dropDownList(Notification::getEventsList(), ['prompt' => '--select--']) ?>

    <?= $form->field($model, 'typeIdsRelated')->dropDownList($model->getTypeNamesAvailable(), ['multiple' => true]) ?>

    <?= $form->field($model, 'sender')->dropDownList(Notification::getSendersAvailable(), ['prompt' => '--select--']) ?>
    <?= $form->field($model, 'receiver')->dropDownList(Notification::getReceiversAvailable(), ['prompt' => '--select--']) ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>
    <?= $form->field($model, 'subject')->textInput() ?>
    <?= $form->field($model, 'body')->textarea(['rows' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
