<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\forms\LoginForm;


class LoginController extends Controller
{
    public function beforeAction($action)
    {
        if ( !parent::beforeAction($action) ) {
            return false;
        }

        $this->layout = "login";
        return true;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if ( \Yii::$app->user->isGuest ) {

            $model = new LoginForm();

            if ( \Yii::$app->request->post() === null || !$model->load( \Yii::$app->request->post()) || !$model->login()) {

                return $this->render('index', [
                    'model'=>$model,
                ]);
            }
        }

        $this->redirect(Url::to('/tasks/'));
    }
}
