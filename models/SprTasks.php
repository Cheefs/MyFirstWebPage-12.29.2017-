<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "spr_tasks".
 *
 * @property int $id id задачи 
 * @property string $name название задачи
 * @property int $type_id указатель на тип задачи
 * @property int $owner_id указатель на ответственное лицо
 * @property string $bdate дата и время начала задачи
 * @property string $edate дата и время окончания задачи
 * @property string $createdatetime время создания записи
 * @property int $createuserid указатель на создателя записи
 * @property int $subsribedUsersCount количество участников задачи
 *
 * @property LnkTaskStatuses[] $lnkTaskStatuses
 * @property LnkTaskUsers[] $lnkTaskUsers
 * @property SprUsers $createuser
 * @property SprUsers $owner
 * @property SprTaskTypes $type
 *
 */
class SprTasks extends \yii\db\ActiveRecord
{

    public $subsribedUsersCount = null;


    public function getVwmodel ($id,$type ) // Метод получения информации с вьюхи
    {
        $vwModel = VwUserComments::find()
            ->where ('task_id' == $id )
            ->one();

        if($type == 'status') // Получить статус
        {
            return $vwModel->status_name;
        }

        if( $type == 'datetime') // Получить время последнего комментария
        {
            return $vwModel->createdatetime;
        }
        if( $type == 'task_id') // получить id задачи
        {
            return $vwModel->task_id;
        }

        if($type == 'task_users')
        {
            return $vwModel->lnktaskusers_id;
        }
//        if( $type ='owner') // получить короткое ФИО ответственного лица
//        {
//            $tmp = $vwModel->lastname . ' '. $vwModel->firstname[0].'. '. $vwModel->secondname[0]. '.';
//            return $tmp;
//        }
    }



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spr_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_id','bdate'], 'required'],
            [['type_id', 'owner_id', 'createuserid'], 'integer'],
            [['bdate', 'edate', 'createdatetime'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['createuserid'], 'exist', 'skipOnError' => true, 'targetClass' => SprUsers::className(), 'targetAttribute' => ['createuserid' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprUsers::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SprTaskTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => Yii::t('tasks', 'Type ID'),
            'owner_id' => Yii::t('tasks', 'Owner ID'),
            'bdate' => Yii::t('tasks', 'Begin date'),
            'edate' => Yii::t('tasks', 'End date'),
            'createdatetime' => Yii::t('tasks', 'Create datetime'),
            'createuserid' => Yii::t('tasks', 'Create user id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskStatuses()
    {
        return $this->hasMany(LnkTaskStatuses::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnkTaskUsers()
    {
        return $this->hasMany(LnkTaskUsers::className(), ['task_id' => 'id']);
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
    public function getOwner()
    {
        return $this->hasOne(SprUsers::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(SprTaskTypes::className(), ['id' => 'type_id']);
    }




}
