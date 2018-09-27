<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spr_task_statuses".
 *
 * @property int $id
 * @property string $name
 * @property string $createdatetime
 * @property int $createuserid
 *
 * @property LnkTaskStatuses[] $lnkTaskStatuses
 * @property LnkTaskStatusesOrders[] $lnkTaskStatusesOrders
 * @property LnkTaskStatusesOrders[] $lnkTaskStatusesOrders0
 * @property SprUsers $createuser
 */
class SprTaskStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spr_task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'createuserid'], 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'createdatetime' => Yii::t('app', 'Createdatetime'),
            'createuserid' => Yii::t('app', 'Createuserid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskStatuses()
    {
        return $this->hasMany(LnkTaskStatuses::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskStatusesOrders()
    {
        return $this->hasMany(LnkTaskStatusesOrders::className(), ['from_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskStatusesOrders0()
    {
        return $this->hasMany(LnkTaskStatusesOrders::className(), ['to_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateuser()
    {
        return $this->hasOne(SprUsers::className(), ['id' => 'createuserid']);
    }
}
