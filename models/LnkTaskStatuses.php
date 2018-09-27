<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lnk_task_statuses".
 *
 * @property int $id Id статуса
 * @property int $task_id Id мероприятия
 * @property int $status_id Id статуса
 * @property string $createdatetime Дата создания запаси
 * @property int $createuserid Пользователь создавший запись
 *
 * @property SprTaskStatuses $status
 * @property SprTasks $task
 * @property SprUsers $createuser
 */
class LnkTaskStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lnk_task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'status_id', 'createuserid'], 'required'],
            [['task_id', 'status_id', 'createuserid'], 'integer'],
            [['createdatetime'], 'safe'],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprTaskStatuses::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprTasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['createuserid'], 'exist', 'skipOnError' => true, 'targetClass' => SprUsers::className(), 'targetAttribute' => ['createuserid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tasks', 'ID'),
            'task_id' => Yii::t('tasks', 'Task ID'),
            'status_id' => Yii::t('tasks', 'Status ID'),
            'createdatetime' => Yii::t('tasks', 'Create datetime'),
            'createuserid' => Yii::t('tasks', 'Create datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(SprTaskStatuses::className(), ['id' => 'status_id']);
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
    public function getCreateuser()
    {
        return $this->hasOne(SprUsers::className(), ['id' => 'createuserid']);
    }
}
