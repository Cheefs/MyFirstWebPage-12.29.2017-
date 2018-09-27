<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\SprTaskTypes;
use kartik\datetime\DateTimePicker;
use yii\jui\AutoComplete;
use \app\models\SprTasksForm;
use \yii\web\JsExpression;



/* @var $this yii\web\View */
/* @var $model app\models\SprTasksForm */
/* @var $form yii\widgets\ActiveForm */
//$js = "$('#sprtasks-owner_fio').on('key', function( event, ui ) {
//    console.log('1');
//});";
//$this->registerJs($js);

?>

<div class="spr-tasks-form">


    <?php $form = ActiveForm::begin([
            'id' => 'new-task-form'
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(SprTaskTypes::find()->all(), 'id', 'name' )) ?>


    <?php
    echo $form->field($model,'ownerlogin')->widget(
        AutoComplete::className(), [
        'clientOptions' => [
            'appendTo' => '#new-task-form',
            'source' => new JsExpression("function(request, response) {
                                var url = \"\/".Yii::$app->controller->id."\/user-search\/\";
                                                 
                                $.getJSON( url, { term: request.term }, response);
                             }"),

            'select' => new JsExpression("function( event, ui ) {
                                  event.preventDefault();  
                                  $('#sprtasksform-ownerlogin').val(ui.item.name);                                
                            }"),
            'autoFill' => true,
            'Focus' => true,
            'minLength' => '3',

            ],
            'options' => [
                'class' => 'form-control',

         //       'value' => \Yii::$app->user->identity->username,

            ]
         ]);
    ?>

    <?php // date('Y-m-d H:i:s',strtotime('08-Сен-2018 11:55')); ?>

    <?= $form->field($model, 'bdate')->widget(DateTimePicker::className(),
    [
        'name' => 'datetime_10',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['placeholder' => 'Select operating time ...'],

        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy hh:ii',
            'startDate' => date('d-m-Y H:i', time()+3600*7),
        ]
    ]) ?>

    <?=   $form->field($model, 'edate')->widget(DateTimePicker::className(),
        [
            'name' => 'datetime_10',
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'options' => ['placeholder' => \Yii::t('tasks','Select operating time ...')],
//            'convertFormat' => true,               потом разобрать, для чего он нужен
            'pluginOptions' => [
                'autoclose'=>true,
                'format' =>  'dd-mm-yyyy hh:ii',
                'startDate' => date('d-m-Y H:i', time() + 3600 + 3600*7),
            ]
        ]);
  ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
