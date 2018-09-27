<?php

namespace app\controllers;

use app\models\UpdateSprUsersForm;
use Yii;
use app\models\SprUsers;
use app\models\SprUsersSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use \app\models\NewSprUsersForm;



/**
 * UsersController implements the CRUD actions for SprUsers model.
 */
class UsersController extends Controller
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
     * Lists all SprUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SprUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SprUsers model.
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
     * Creates a new SprUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewSprUsersForm();

        $tmp = $model->userpswd; //Запомнить введенный пароль пользователя

        if ($model->load(Yii::$app->request->post())) {
            $model = $this->Upload($model);
            $model->userpswd = md5( $model->userpswd ); //Шифрование пароля пользователя

            if ($model->validate() && $model->save(false) ) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        $model->userpswd = $tmp;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SprUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel( $id);

        $tmp = $model->userpswd; //Запомнить введенный пароль пользователя

        if ($model->load(Yii::$app->request->post())) {              //  && $model->save()
            $model = $this->Upload($model);
            $model->userpswd = md5( $model->userpswd );              //  Шифрование пароля пользователя

            if ($model->validate() && $model->save(false)) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        $model->userpswd = $tmp;
        return $this->render('update', [
            'model' => $model,
        ]);
    }

//
//$tmp = $model->userpswd; //Запомнить введенный пароль пользователя
//
//if ($model->load(Yii::$app->request->post())) {
//$model = $this->Upload($model);
//$model->userpswd = md5( $model->userpswd ); //Шифрование пароля пользователя
//
//if ($model->validate() && $model->save(false) ) {
//return $this->redirect(['index', 'id' => $model->id]);
//}
//}
//
//$model->userpswd = $tmp;
//


    /**
     * Deletes an existing SprUsers model.
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
     * Finds the SprUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SprUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UpdateSprUsersForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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

        //Проверяем, является ли пользователь админом
        if ( !\Yii::$app->user->identity->isAdmin ) {
            //Отправляем на стрианцу работы с задачами, она доступна всем пользователям
            $this->redirect(['/tasks']);
            return false;
        }
        return true;
    }


    /**
     * @param $model
     * @return mixed
     */
    public function Upload($model)
    {
        $model->photo = null;
        $tmp = UploadedFile::getInstance($model, 'upload_file');
        if ( $tmp !== null ) {
            $tmp->saveAs(\Yii::getAlias('@webroot').'/uploads/' . $tmp->name);

            $model->photo = $tmp->name;
        }
        return $model;
    }

}
