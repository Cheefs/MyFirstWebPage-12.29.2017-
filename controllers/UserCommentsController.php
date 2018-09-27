<?php

namespace app\controllers;

use Yii;
use app\models\LnkTaskUsers;
use app\models\VwUserComments;
use app\models\LnkUserComments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * UserCommentsController implements the CRUD actions for LnkUserComments model.
 */
class UserCommentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LnkUserComments models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new LnkUserComments();
        $task = LnkTaskUsers::find()
                ->where(LnkUserComments::tableName().'.lnktaskusers_id' == 'id')
                ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('view?id='.$task->id);
        }


        return $this->render('index', [
            'model' => $model,
            'task' => $task,
        ]);
    }

    /**
     * Displays a single LnkUserComments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {


        if($this->findModel($id) == false) {
            $this->redirect('create');
        }

        // vwModel
        $userInfo =  VwUserComments::find()->orderBy(["createdatetime" => SORT_DESC])
            ->where (LnkUserComments::tableName().'.lnktaskusers_id' == VwUserComments::tableName().'.lnktaskusers_id')
            ->all();

        $lnkTaskuser = LnkTaskUsers::find()->where( ['user_id' => \Yii::$app->user->identity->id, 'task_id' => $id ])->one();

        $comment = new LnkUserComments();

        if($lnkTaskuser != null)
        {
            $comment->lnktaskusers_id = $lnkTaskuser->id;
        }

        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            return $this->redirect('view?id='.$id);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'comment'=> $comment,
            //'lnkTaskuser' => $lnkTaskuser,
            'userInfo' =>  $userInfo
        ]);
    }

    /**
     * Creates a new LnkUserComments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LnkUserComments();
        $model ->lnktaskusers_id = \Yii::$app->user->identity->getId();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LnkUserComments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LnkUserComments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function beforeAction($action)
    {
        if ( !parent::beforeAction($action) ) {
            return false;
        }
        //Проверяем, что пользователь залогинен
        if( \Yii::$app->user->isGuest ){
            //Нет, не залогинен - отправляем на страницу авторизации
            $this->redirect(Url::to(['/']));
            return false;
        }

        //Проверяем, является ли пользователь админом
      //  if ( !\Yii::$app->user->identity->isAdmin ) {
            //Отправляем на стрианцу работы с задачами, она доступна всем пользователям
           // $this->redirect(['/tasks']);
            //return false;
        //}
        return true;
    }


    /**
     * Finds the LnkUserComments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LnkUserComments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LnkUserComments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
