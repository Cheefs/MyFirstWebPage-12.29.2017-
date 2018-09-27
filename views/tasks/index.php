<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SprTasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $myTasks []  список моих задач */
/* @var $vwModel []  TaskView */

/* @var $creators []  Users */

//$this->title = Yii::t('app', 'Spr Tasks');
//$this->params['breadcrumbs'][] = $this->title;

$modalwindow = '$(document).ready(function() {

      $("table").click(function()
        {
            var id = $(this).id;
            
            $("#modalView").modal("show").find(".modal-body").load("/'.\Yii::$app->controller->id.'/view?id="+id+"   .spr-tasks-view");   
          console.log($(this).attr("id"));
          });       
})';

?>


<div class="spr-tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h1>
        <?= \Yii::t('tasks','Following') ?>
    </h1>
<hr>
    <?php   foreach ($vwModel as $model) {

        $users = explode(';',$model->subscribed_user_ids);
        $tmp = null;

            for($i = 0; $i < count($users); $i++)
            {
                if( $users[$i] == \Yii::$app->user->id)
                $tmp = $users[$i];
            }

            if( $tmp !== null && $tmp == \Yii::$app->user->id) {

        ?>


        <div class ='following'>
            <div class= "col-sm-3 ">
                <div class="panel panel-default taskContainer">
                    <div class="panel-heading">
                        <h3 class="panel-title">

                            <div class="taskHeader" >
                                <?=
                                $model->task_name,
                                //$value->name ,
                                Html::a('', ['view', 'id' => $model->id], ['class' => 'glyphicon glyphicon-search myBtn ']);?>
                            </div>
                        </h3>
                    </div>
                    <div>
                        <?=
                        DetailView::widget([
                             'model' => $model,
                            'id' => $model->id,
                            'attributes' => [
                                    'id',
                                'task_name',
                                [
                                    'attribute' =>'bdate',
                                    'value' => function($model)
                                    {
                                        return  date("d-m-Y  H:m", strtotime( $model->bdate ) );
                                    }
                                ],

                                [
                                    'attribute' =>'edate',
                                    'value' => function($model)
                                    {
                                        return  date("d-m-Y h:m", strtotime( $model->edate ) );
                                    }
                                ],

                                [
                                    'label' => \Yii::t('tasks','Users Count'),
                                    'format' => 'raw',

                                       'value' => function($model) {
                                        return $model->subsribedUsersCount;
                                    }
                                ],

                                [
                                    'label' => \Yii::t('users','Task Status'),
                                    'value' => function($model)
                                    {
                                        return $model->task_status;
                                    }
                                ],
                            ]
                        ])?>
                    </div>

<!--                 С учетом нынешней даты и времени, сравниваем дату последнего комментария, и меняем класс у элемента div-->
                    <div class=
                        <?php


                            if( strtotime(date("d-m-Y  H:m:s"))  < strtotime( $model->createComment_time ) + 604800  )
                            {
                                $class = 'lastCommentField-new';
                            }

                            if ( strtotime(date("d-m-Y  H:m:s"))  > strtotime( $model->createComment_time ) + 604800  )
                            {
                                $class = 'lastCommentField';
                            }

                            if ( $model->comment_id === null)
                            {
                                $class = 'lastCommentField-none';
                            }
                            echo $class; ?>>

                        <?php

                            $time = date("d-m-Y  H:m", strtotime( $model->createComment_time ) ); // Корректировка вывода даты и времени пользователю

                            if($model->comment_id !== null)
                            {
//                                var_dump($commentmodel[$model->comment_id]->task_id);


                                $url = '/user-comments/view?id='.$model->id; // переменная для хранения URla (носит чисто коссметический характер, для читаемости кода)
                                echo   $text = \Yii::t('users','Last Comment').':<br> '. $time . ' '.
                                    Html::a('', Url::to($url), ['class' => 'glyphicon glyphicon-envelope myBtn ']);
                            }

                            else
                            {
                                $url ='/user-comments/';

                                echo \Yii::t('tasks','No comments').':<br> '.
                                    Html::a('', Url::to($url), ['class' => 'glyphicon glyphicon-envelope myBtn ']);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

            <?php }} ?>

 <h1 class="MyTasks">
     <?= \Yii::t('tasks','My Tasks').' '. Html::a('', ['create'], ['class' => 'glyphicon glyphicon-new-window myBtn']) ?>
 </h1>
    <hr>

<?php
    //Выбор всех данных с массива vwModel - вью модель с базы данных, содержит все необходимые мне данные из всех таблиц
    foreach ($vwModel as $model) {
            // Проверяем, является ли данный пользователь, создателем задачи либо ответственным лицом данной задачи
            if( $model->owner_id == \Yii::$app->user->id || $model->creator_id == \Yii::$app->user->id )
            {

?>
        <div class= "col-sm-3">
            <div class="panel panel-default taskContainer">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="taskHeader" >
                            <?=
                                 $model->task_name,
                                Html::a('', ['update', 'id' => $model->id], ['class' => 'glyphicon glyphicon-pencil myBtn']),
                                Html::a('', ['view', 'id' => $model->id], ['class' => 'glyphicon glyphicon-search myBtn '])
                            ?>
                        </div>
                    </h3>

                </div>
                <div>
                    <?=
                    DetailView::widget([

                        'model' => $model,
                        'id' =>$model->id,
                        'attributes' => [
                                'id',
                            'task_name',
                            [
                                'label' => Yii::t('tasks', 'Type ID'),

                                  'value' => function($model) {
                                    return $model->task_type;
                                }
                            ],
                            [
                                'label' => Yii::t('tasks', 'Owner ID'),
                                 'value' => function($model)
                                 {

                                    // Склеиваем короткое ФИО ответственного лица
                                    // mb_substr() - функция разбивающая строку состоящую из 2х байтовых символов (UTF8 кодировка)
                                    // Первый параметр - строка, второй параметры - с какого символа начинаем, 3й параметр - количество возвращаемых символов

                                     $fio = $model->owner_lastname. ' '. mb_substr($model->owner_firstname,0,1). '. ';
                                     if( $model->owner_secondname != null || $model->owner_secondname != '')
                                     {
                                         $fio .=' '. mb_substr($model->owner_secondname,0,1).'.';
                                     }

                                  return $fio;
                                }
                            ],

                            [
                                'attribute' =>'bdate',
                                'value' => function($model)
                                {
                                    return  date("d-m-Y H:m", strtotime( $model->bdate ) );
                                }
                            ],

                            [
                                'attribute' =>'edate',
                                'value' => function($model)
                                {


                                    return  date("d-m-Y H:m", strtotime( $model->edate ) );
                                }
                            ],

                            'createdatetime',
//                            [
//                                'label' => Yii::t('tasks', 'Create user id'),
//    нуждается в доработке    //Вовыд короткого ФИО создателя задачи, и проверка на наличие отчества, если его нет, невыводим нечего
//    вывод не корректный       'value' => $creators[$model->creator_id]->lastname .' '. mb_substr( $creators[ $model->creator_id]->firstname,0,1).'. '.
//                                    ( $creators[$model->creator_id ]->secondname? mb_substr( $creators[ $model->creator_id]->secondname ,0,1).'.':''),
//                            ],

                            [
                                'label' => \Yii::t('tasks','Users Count'),
                                'format' => 'raw',
                                    'value' => function($model) {
                                 //   if( $model->)
                                    return $model->subsribedUsersCount .Html::a('','#', ['class' => 'glyphicon glyphicon-user myBtn']); ;
                                }
                            ],
                        ]
                    ])?>
                </div>

<!--     С учетом нынешней даты и времени, сравниваем дату последнего комментария, и меняем класс у элемента div-->
                 <div class=
                     <?php

                         if( strtotime(date("d-m-Y  H:m:s"))  < strtotime( $model->createComment_time ) + 604800  )
                         {
                             $class = 'lastCommentField-new';
                         }

                         if ( strtotime(date("d-m-Y  H:m:s"))  > strtotime( $model->createComment_time ) + 604800  )
                         {
                             $class = 'lastCommentField';
                         }

                         if ( $model->comment_id === null)
                         {
                             $class = 'lastCommentField-none';
                         }
                             echo $class; ?>>

                     <?php
                            $time = date("d-m-Y  H:m", strtotime( $model->createComment_time ) ); // Корректировка вывода даты и времени пользователю

                            if($model->comment_id !== null)
                            {
                                $url = '/user-comments/view?id='.$model->comment_id; // переменная для хранения URla (носит чисто коссметический характер, для читаемости кода)
                                echo   $text = \Yii::t('users','Last Comment').':<br> '. $time . ' '.
                                    Html::a('', Url::to($url), ['class' => 'glyphicon glyphicon-envelope myBtn ']);
                            }

                            else
                            {
                               $url ='/user-comments/';

                               echo \Yii::t('tasks','No comments').':<br> '.
                                   Html::a('', Url::to($url), ['class' => 'glyphicon glyphicon-envelope myBtn ']);
                            }
                        ?>
                    </div>
                </div>
            </div>

    <?php }} ?>

    <?php

    Modal::begin([
        'header' =>\Yii::t('tasks', 'View'),
        'id' => 'modalView',
        'size' => 'modal-lg',


    ]);

    Modal::end();

    ?>
</div>
