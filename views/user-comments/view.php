<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LnkUserCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $commentList yii\data\ActiveDataProvider */
/* @var $userInfo[] VwUserComments */

$this->title = Yii::t('users', 'Users Comments' ).':'; // Заглавие блока комментариев
$tmpStart = date("d-m-Y  h:m", strtotime($userInfo[ $model->id]->bdate )); //Форматирование даты начала задачи
$tmpEnd = date("d-m-Y  h:m", strtotime($userInfo[ $model->id]->edate )); //Форматирование даты окончания задачи

//$this->params['breadcrumbs'][] = $this->title;



?>
<div class="lnk-user-comments-view">

    <h1>
        <?= $userInfo[ $model->id]->task_name  ?>
    </h1>

    <h2>
       <?= \Yii::t('tasks','Task Start').': '.$tmpStart ?> <br>
       <?= \Yii::t('tasks','Task End').': '.$tmpEnd ?>
    </h2>


   <h2 class="title"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<div class="commentContainer ">
<?php foreach ( $userInfo as $info ) { ?>

    <?php   ?>

        <div class ="conteinerInside">
            <div class="photo">
                <?php
                    $tmp = \Yii::getAlias('@webroot').'/uploads/'. $info -> photo ;
                    if( file_exists($tmp))
                    {
                        echo  Html::img( Url::to('/uploads/'. $info -> photo));
                    }
                  ?>
            </div>

            <div class="col-sm-8 comment"?>
                <div class="commentInfo">
                    <?php
                    if( $info->secondname == null)
                    {
                        $info->secondname = '';
                    }
                   echo Yii::t('users','Comment From User').': '.( $info->lastname. ' ' . $info->firstname . ' ' . $info->secondname )?>

                </div>
                <hr>
                <div class="commentText">
                    <?= $info -> comment ?>
                    <hr>

                </div>
                <div class="commentSignature">
                    <?=  Yii::t('users','Create Date') .': '. $info -> createdatetime ?>
                </div>
             </div>
        </div>

<?php }  ?>
</div>
        <?php $form = ActiveForm::begin(); ?>
            <div class="textInput">
                 <?php
                 $model->comment= '';
                    echo $form->field($model, 'comment')->textarea(['rows' => 6]) ->label(false)
                 ?>
            </div>

        <div class="btnAddComment">
            <?= Html::submitButton(Yii::t('users', 'Create Comment'), ['class' => 'btn btn-success btnAddComment ']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
