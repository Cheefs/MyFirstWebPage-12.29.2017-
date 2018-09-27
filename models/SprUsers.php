<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spr_users".
 *
 * @property int $id id пользователя
 * @property string $username логин пользователя
 * @property string $userpswd пароль пользователя
 * @property string $firstname имя пользователя
 * @property string $secondname фамилия пользователя
 * @property string $lastname отчество пользователя
 * @property string $createdatetime дата и время создания записи
 * @property int $is_admin админ или нет
 *
 * @property LnkTaskStatuses[] $lnkTaskStatuses
 * @property LnkTaskUsers[] $lnkTaskUsers
 * @property LnkTaskUsers[] $lnkTaskUsers0
 * @property SprTaskStatuses[] $sprTaskStatuses
 * @property SprTaskTypes[] $sprTaskTypes
 * @property SprTasks[] $sprTasks
 * @property SprTasks[] $sprTasks0
 */
class SprUsers extends \yii\db\ActiveRecord implements  \yii\web\IdentityInterface
{
    public $upload_file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spr_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'userpswd', 'firstname', 'lastname'], 'required'],
            [['createdatetime','photo'], 'safe'],
            [['upload_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png, image/jpeg',],
            [['is_admin'], 'integer'],
            [['username'], 'string', 'max' => 45],
            [['userpswd'], 'string', 'max' => 32],
            [['firstname', 'secondname', 'lastname'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('users', 'ID'),
            'username' => Yii::t('users', 'Username'),
            'userpswd' => Yii::t('users', 'Userpswd'),
            'firstname' => Yii::t('users', 'Firstname'),
            'secondname' => Yii::t('users', 'Secondname'),
            'lastname' => Yii::t('users', 'Lastname'),
            'createdatetime' => Yii::t('users', 'Create datetime'),
            'is_admin' => Yii::t('users', 'IsAdmin'),
            'photo' => \Yii::t ('users', 'Photo'),
            'upload_file' => \Yii::t('users','Photo'),
        ];
    }


    /**
     * @return boolean
     */
    public function getIsAdmin()
    {
        return ($this->is_admin !== null && $this->is_admin !== 0);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskStatuses()
    {
        return $this->hasMany(LnkTaskStatuses::className(), ['createuserid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskUsers()
    {
        return $this->hasMany(LnkTaskUsers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskUsers0()
    {
        return $this->hasMany(LnkTaskUsers::className(), ['createuserid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSprTaskStatuses()
    {
        return $this->hasMany(SprTaskStatuses::className(), ['createuserid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSprTaskTypes()
    {
        return $this->hasMany(SprTaskTypes::className(), ['createuserid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSprTasks()
    {
        return $this->hasMany(SprTasks::className(), ['createuserid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSprTasks0()
    {
        return $this->hasMany(SprTasks::className(), ['owner_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['userpswd' => $token]);
    }


    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->userpswd;
    }


    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
