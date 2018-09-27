<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lnk_task_statuses_orders".
 *
 * @property int $id Id 
 * @property int $from_status_id Id начального статуса
 * @property int $to_status_id Id конечного статуса
 *
 * @property SprTaskStatuses $fromStatus
 * @property SprTaskStatuses $toStatus
 */
class LnkTaskStatusesOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lnk_task_statuses_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_status_id', 'to_status_id'], 'required'],
            [['from_status_id', 'to_status_id'], 'integer'],
            [['from_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprTaskStatuses::className(), 'targetAttribute' => ['from_status_id' => 'id']],
            [['to_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprTaskStatuses::className(), 'targetAttribute' => ['to_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tasks', 'ID'),
            'from_status_id' => Yii::t('tasks', 'From Status ID'),
            'to_status_id' => Yii::t('tasks', 'To Status ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromStatus()
    {
        return $this->hasOne(SprTaskStatuses::className(), ['id' => 'from_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToStatus()
    {
        return $this->hasOne(SprTaskStatuses::className(), ['id' => 'to_status_id']);
    }
}
