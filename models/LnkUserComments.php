<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lnk_user_comments".
 *
 * @property int $id Id комментария
 * @property int $lnktaskusers_id id указтель пользователя создаго комментарий
 * @property string $comment Комментарий
 * @property string $createdatetime Дата создания комментария
 *
 * @property LnkTaskUsers $task-users
 */
class LnkUserComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lnk_user_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lnktaskusers_id', 'comment'], 'required'],
            [['lnktaskusers_id'], 'integer'],
            [['comment'], 'string'],
            [['createdatetime'], 'safe'],
            [['lnktaskusers_id'], 'exist', 'skipOnError' => true, 'targetClass' => LnkTaskUsers::className(), 'targetAttribute' => ['lnktaskusers_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('users', 'ID'),
            'lnktaskusers_id' => Yii::t('users', 'Task users ID'),
            'comment' => Yii::t('users', 'Comment'),
            'createdatetime' => Yii::t('users', 'Create datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLnktaskusers()
    {
        return $this->hasOne(LnkTaskUsers::className(), ['id' => 'lnktaskusers_id']);
    }
}
