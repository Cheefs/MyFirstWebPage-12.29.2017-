<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LnkTaskStatusesOrders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lnk-task-statuses-orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from_status_id')->textInput() ?>

    <?= $form->field($model, 'to_status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
