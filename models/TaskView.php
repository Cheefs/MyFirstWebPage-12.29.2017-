<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taskView".
 *
 * @property int $id id задачи 
 * @property string $task_name название задачи
 * @property int $type_id указатель на тип задачи
 * @property int $owner_id указатель на ответственное лицо
 * @property string $bdate дата и время начала задачи
 * @property string $edate дата и время окончания задачи
 * @property string $createdatetime время создания записи
 * @property int $creator_id указатель на создателя записи
 * @property string $subscribed_user_ids
 * @property string $task_status
 * @property string $createComment_time Дата создания комментария
 * @property string $owner_firstname имя пользователя
 * @property string $owner_secondname фамилия пользователя
 * @property string $owner_lastname отчество пользователя
 * @property string $task_type Название
 * @property int $subsribedUsersCount
 */
class TaskView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taskView';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'owner_id', 'creator_id', 'comment_id', 'subsribedUsersCount'], 'integer'],
            [['task_name', 'type_id', 'owner_id', 'creator_id'], 'required'],
            [['bdate', 'edate', 'createdatetime', 'createComment_time'], 'safe'],
            [['subscribed_user_ids'], 'string'],
            [['task_name', 'task_status', 'owner_firstname', 'owner_secondname', 'owner_lastname', 'task_type'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tasks', 'ID'),
            'task_name' => Yii::t('tasks', 'Task Name'),
            'type_id' => Yii::t('tasks', 'Type ID'),
            'owner_id' => Yii::t('tasks', 'Owner ID'),
            'bdate' => Yii::t('tasks', 'Task Start'),
            'edate' => Yii::t('tasks', 'Task End'),
            'createdatetime' => Yii::t('tasks', 'Create datetime'),
            'creator_id' => Yii::t('tasks', 'Creator ID'),
            'subscribed_user_ids' => Yii::t('tasks', 'Subscribed User Ids'),
            'task_status' => Yii::t('tasks', 'Task Status'),
            'createComment_time' => Yii::t('tasks', 'Create Comment Time'),
            'owner_firstname' => Yii::t('tasks', 'Owner Firstname'),
            'owner_secondname' => Yii::t('tasks', 'Owner Secondname'),
            'owner_lastname' => Yii::t('tasks', 'Owner Lastname'),
            'task_type' => Yii::t('tasks', 'Task Type'),
            'subsribedUsersCount' => Yii::t('tasks', 'Subsribed Users Count'),
            'comment_id' => Yii::t('app', 'Comment ID'),
        ];
    }
}
