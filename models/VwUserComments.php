<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_user_comments".
 *
 * @property int $id Id комментария
 * @property int $lnktaskusers_id id указтель пользователя создаго комментарий
 * @property string $comment Комментарий
 * @property string $createdatetime Дата создания комментария
 * @property int $user_id id пользователя
 * @property string $username логин пользователя
 * @property string $lastname отчество пользователя
 * @property string $firstname имя пользователя
 * @property string $secondname фамилия пользователя
 * @property string $photo
 * @property int $task_id id задачи 
 * @property string $task_name название задачи
 * @property string $bdate дата и время начала задачи
 * @property string $edate дата и время окончания задачи
 * @property int $owner_id указатель на ответственное лицо
 */
class VwUserComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_user_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lnktaskusers_id', 'user_id', 'task_id', 'owner_id'], 'integer'],
            [['lnktaskusers_id', 'comment', 'username', 'firstname', 'secondname', 'task_name', 'owner_id'], 'required'],
            [['comment'], 'string'],
            [['createdatetime', 'bdate', 'edate'], 'safe'],
            [['username', 'photo'], 'string', 'max' => 45],
            [['lastname', 'firstname', 'secondname', 'task_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('users', 'ID'),
            'lnktaskusers_id' => Yii::t('users', 'Lnktaskusers ID'),
            'comment' => Yii::t('user', 'Comment'),
            'createdatetime' => Yii::t('app', 'Createdatetime'),
            'user_id' => Yii::t('users', 'User ID'),
            'username' => Yii::t('users', 'Username'),
            'lastname' => Yii::t('users', 'Lastname'),
            'firstname' => Yii::t('users', 'Firstname'),
            'secondname' => Yii::t('users', 'Secondname'),
            'photo' => Yii::t('users', 'Photo'),
            'task_id' => Yii::t('users', 'Task ID'),
            'task_name' => Yii::t('users', 'Task Name'),
            'bdate' => Yii::t('users', 'Bdate'),
            'edate' => Yii::t('user', 'Edate'),
            'owner_id' => Yii::t('users', 'Owner ID'),
        ];
    }
}
