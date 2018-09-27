<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LnkUserComments */

$this->title = Yii::t('users', 'Create Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'User Comment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lnk-user-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
