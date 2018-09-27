<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LnkTaskStatusesOrders */

$this->title = Yii::t('app', 'Create Lnk Task Statuses Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lnk Task Statuses Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lnk-task-statuses-orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
