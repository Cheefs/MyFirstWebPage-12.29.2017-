<?php
/**
 * Created by PhpStorm.
 * User: diana
 * Date: 27.09.18
 * Time: 13:03
 */

namespace app\models;

/**
* @property string $userpswd2  проверка-подтверждение пароля
*/

class NewSprUsersForm extends SprUsers
{

    public $userpswd2 = null;

    public function rules()
    {
        return [
            [['username', 'userpswd', 'firstname', 'lastname'], 'required'],
            ['username', 'unique'],
            [['createdatetime', 'photo'], 'safe'],
            [['upload_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png, image/jpeg',],
            [['is_admin'], 'integer'],
            [['username'], 'string', 'max' => 45],
            [['userpswd'], 'string', 'max' => 32],
            [['firstname', 'secondname', 'lastname'], 'string', 'max' => 64],

            ['userpswd2', 'required', 'when' => function( $model ) {
                return $model->userpswd !== null;
            }],

            [['userpswd', 'userpswd2'], 'validatePasswords'],
        ];
    }


    public function validatePasswords() {
        if ( $this->userpswd != md5( $this->userpswd2 ) ) {
            $this->addError('userpswd2', \Yii::t('users', 'password does not match'));
        }
    }






}