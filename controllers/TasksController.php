<?php

namespace app\controllers;

use app\models\LnkTaskUsers;
use app\models\SprTaskTypes;
use app\models\SprUsers;
use app\models\VwUserComments;
use Yii;
use \app\models\SprTasksForm;
use app\models\SprTasks;
use app\models\SprTasksSearch;
use yii\db\Expression;
use yii\jui\Selectable;
use yii\web\Controller;
use yii\web\JsExpression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\TaskView;
/**
 *
 * TasksController implements the CRUD actions for SprTasks model.
 */
class TasksController extends Controller
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
     * Lists all SprTasks models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $query = SprTasks::find()
//            ->select([SprTasks::tableName().'.*',new Expression('COUNT( DISTINCT '.LnkTaskUsers::tableName().'.user_id ) AS subsribedUsersCount')])
//            ->leftJoin(LnkTaskUsers::tableName(), LnkTaskUsers::tableName().'.task_id = '.SprTasks::tableName().'.id')
//            ->groupBy([SprTasks::tableName().'.id']);

//        echo $query->createCommand()->rawSql;
//        die();

    //    $myTasks = $query->all();

        $commentmodel = VwUserComments::find()->all();

        $searchModel = new SprTasksSearch();

        $creators = SprUsers::find()->all();// выбор всех пользователей
        $vwModel = TaskView::find()->all();// Создал массив из данных таблици TaskView

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'creators' => $creators,
            'commentmodel' => $commentmodel,
           // 'myTasks' => $myTasks,
            'vwModel' => $vwModel //Передача массива на представление

        ]);
    }

    /**
     * Displays a single SprTasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SprTasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SprTasksForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->bdate = date('Y-m-d H:i:s', strtotime($model->bdate));
            $model->edate = date('Y-m-d H:i:s', strtotime($model->edate));

            $model->owner_id = SprUsers::findOne(['username' => $model->ownerlogin])->id;
            $model->createuserid = \Yii::$app->user->getId();

            $model->save();
            if ($model->save(false) ) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SprTasks model.
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
     * Deletes an existing SprTasks model.
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

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
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
        return true;
    }


    /**
     * Finds the SprTasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SprTasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

        // теперь с формой добавления задач работает другая модель:  SprTasksForm

    protected function findModel($id)
    {
        if (($model = SprTasksForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param $term
     * @return array|bool
     */
    public function actionUserSearch($term)
     {
        if (
            //\Yii::$app->request->isAjax &&
            \Yii::$app->request->isGet && $term !== null && $term != '' && mb_strlen( $term ) >= 3 ) {
            $response = null;
            $result = false;
            $term = preg_replace('/\%/', '', $term);

//            if( $term != ''){
//                $response = SprUsers::find()
//                    ->where( ['like', 'upper(username)', mb_convert_case( $term,MB_CASE_UPPER ) ] )
//                    ->orWhere( ['like', 'upper(firstname)', mb_convert_case( $term,MB_CASE_UPPER ) ] )
//                    ->orWhere( ['like', 'upper(secondname)', mb_convert_case( $term,MB_CASE_UPPER ) ] )
//                    ->orWhere( ['like', 'upper(lastname)', mb_convert_case( $term,MB_CASE_UPPER ) ] )
//                    ->all();
//            }

            if( $term != '') {
                $query = SprUsers::find()
                    ->where(['like',  new Expression('UPPER( CONCAT( COALESCE( CONCAT(lastname, " "), ""),  "",
                                                                                COALESCE( CONCAT(firstname, " "), ""),  "",
                                                                                COALESCE( CONCAT(secondname, " "), "")
                                                                                )
                                                                        )
                                                     '),
                            mb_convert_case( $term,MB_CASE_UPPER )])
                    ->orWhere(['like', 'upper(username)',  mb_convert_case( $term,MB_CASE_UPPER )]);
               // var_dump($query->createCommand()->rawSql);die();
                $response = $query->all();
            }

            if ( $response != null ) {
                $result = [];
                foreach ($response as $row) {
                    $result[]= [ 'id' => $row->id,
                                'name' => $row->username,
                                'label' => $row->lastname.' '.$row->firstname.( $row->secondname !== null && trim( $row->secondname ) != '' ? ' '.$row->secondname :'' ).' ('.$row->username.')'];
                }
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $result;
        } else {
            throw new HttpException(404 ,Yii::t('app', 'Page Not Found'));
        }
    }
}
