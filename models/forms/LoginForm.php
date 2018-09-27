<?php

namespace app\models\forms;

use app\models\SprUsers;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "spr_users".
 *
 * @property string $username логин пользователя
 * @property string $userpswd пароль пользователя
 */
class LoginForm extends SprUsers
{
    public $model;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['username'],
                'required',
//                'message' => \Yii::t('main', 'Enter Username')
            ],

            [
                ['userpswd'],
                'required',
//                'message' => \Yii::t('main', \Yii::t('main','Enter Password'))
            ],

            [['username'], 'string', 'max' => 45],
            [['userpswd'], 'string', 'max' => 32],

        ];
    }

    public function ValidateUser()
    {
        $this->model = SprUsers::findOne(['username' => $this->username]);
        $result = ( $this->model !== null && $this->model->username !== null && $this->username == $this->model->username ? $this->model->userpswd !== null && $this->model->userpswd == md5( $this->userpswd) : false );
        if ( !$result ) {
            $this->addError('userpswd', \Yii::t('main','Incorrect username or password'));
        }
        return $result;
    }

    public function login() {
        $result = $this->ValidateUser();
        if ( $result ) {
            \Yii::$app->user->login( $this->model );
        }
        return $result;
    }

    public function getUser()
    {
        if ($this->username === false) {
            $this->username = SprUsers::findByUsername($this->username);
        }

        return $this-> username;
    }
    

}
