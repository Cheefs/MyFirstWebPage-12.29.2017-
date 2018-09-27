<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spr_task_types".
 *
 * @property int $id Id Записи
 * @property string $name Название
 * @property string $createdatetime Дата и время создания записи
 * @property int $createuserid Указатель на пользователя создавшего запись
 *
 * @property SprUsers $createuser
 * @property SprTasks[] $sprTasks
 */
class SprTaskTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spr_task_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['createdatetime'], 'safe'],
            [['createuserid'], 'integer'],
            [['name'], 'string', 'max' => 64],
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
            'name' => Yii::t('tasks', 'Name'),
            'createdatetime' => Yii::t('tasks', 'Create date time'),
            'createuserid' => Yii::t('tasks', 'Create user id'),
        ];
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
    public function getSprTasks()
    {
        return $this->hasMany(SprTasks::className(), ['type_id' => 'id']);
    }
}
