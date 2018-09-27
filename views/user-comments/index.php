<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LnkUserCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $commentList yii\data\ActiveDataProvider */

$this->title = Yii::t('users', 'Users Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lnk-user-comments-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php $form = ActiveForm::begin(); ?>
    <div class="textInput">

        <?= $form->field($model, 'comment') -> textarea(['rows' => 6])->label(false) ?>
    </div>

    <div class="btnAddComment">
        <?= Html::submitButton(Yii::t('users', 'Create Comment'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php

//
//
//  GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//          //  ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'lnktaskusers_id',
//            'comment:ntext',
//            'createdatetime',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
 ?>

</div>

</div>
