<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LnkTaskStatuses;

/**
 * LnkTaskStatusesSearch represents the model behind the search form of `app\models\LnkTaskStatuses`.
 */
class LnkTaskStatusesSearch extends LnkTaskStatuses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'status_id', 'createuserid'], 'integer'],
            [['createdatetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LnkTaskStatuses::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'task_id' => $this->task_id,
            'status_id' => $this->status_id,
            'createdatetime' => $this->createdatetime,
            'createuserid' => $this->createuserid,
        ]);

        return $dataProvider;
    }
}
