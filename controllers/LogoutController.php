<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class LogoutController extends Controller
{

    public function actionIndex()
    {
        Yii::$app->user->logout();

        return $this->redirect('/login');
    }
}
