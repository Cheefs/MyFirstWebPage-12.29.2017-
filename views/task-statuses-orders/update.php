<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LnkTaskStatusesOrders */

$this->title = Yii::t('app', 'Update Lnk Task Statuses Orders: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lnk Task Statuses Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lnk-task-statuses-orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
