<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LnkUserComments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lnk-user-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'createdatetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('users', 'Save'),['Create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
