<?php

namespace app\controllers;

use Yii;
use app\models\LnkTaskStatuses;
use app\models\LnkTaskStatusesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;


/**
 * LnkTaskStatusesController implements the CRUD actions for LnkTaskStatuses model.
 */
class LnkTaskStatusesController extends Controller
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
     * Lists all LnkTaskStatuses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LnkTaskStatusesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LnkTaskStatuses model.
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
     * Creates a new LnkTaskStatuses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
        $model = new LnkTaskStatuses();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->createuserid = Yii::$app->user->getId();
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
     * Updates an existing LnkTaskStatuses model.
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
     * Deletes an existing LnkTaskStatuses model.
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
        if ( !\Yii::$app->user->identity->isAdmin ) {
            //Отправляем на стрианцу работы с задачами, она доступна всем пользователям
            $this->redirect(['/tasks']);
            return false;
        }
        return true;
    }


    /**
     * Finds the LnkTaskStatuses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LnkTaskStatuses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LnkTaskStatuses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
