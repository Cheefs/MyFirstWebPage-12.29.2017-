<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LnkUserCommentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lnk-user-comments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lnktaskusers_id') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'createdatetime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('users', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('users', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
