<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lnk_task_users".
 *
 * @property int $id Id
 * @property int $task_id Id мероприятия
 * @property int $user_id Id пользователя
 * @property string $createdatetime Дата создания
 * @property int $createuserid Id пользователя создавшего запись
 *
 * @property SprTasks $task
 * @property SprUsers $user
 * @property SprUsers $createuser
 * @property LnkUserComments[] $lnkUserComments
 */
class LnkTaskUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lnk_task_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'createuserid'], 'required'],
            [['task_id', 'user_id', 'createuserid'], 'integer'],
            [['createdatetime'], 'safe'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprTasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprUsers::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['createuserid'], 'exist', 'skipOnError' => true, 'targetClass' => SprUsers::className(), 'targetAttribute' => ['createuserid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('users', 'ID'),
            'task_id' => Yii::t('users', 'Task ID'),
            'user_id' => Yii::t('users', 'User ID'),
            'createdatetime' => Yii::t('users', 'Create datetime'),
            'createuserid' => Yii::t('users', 'Create user id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(SprTasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(SprUsers::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateuser()
    {
        return $this->hasOne(SprUsers::className(), ['id' => 'createuserid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkUserComments()
    {
        return $this->hasMany(LnkUserComments::className(), ['lnktaskusers_id' => 'id']);
    }
}
