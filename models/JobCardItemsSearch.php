<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobCardItems;

/**
 * JobCardItemsSearch represents the model behind the search form of `app\models\JobCardItems`.
 */
class JobCardItemsSearch extends JobCardItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'job_card_id', 'item_id', 'cost', 'warranty', 'warranty_type', 'status', 'current_location'], 'integer'],
            [['description'], 'safe'],
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
        $query = JobCardItems::find();

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
            'job_card_id' => $this->job_card_id,
            'item_id' => $this->item_id,
            'cost' => $this->cost,
            'warranty' => $this->warranty,
            'warranty_type' => $this->warranty_type,
            'status' => $this->status,
            'current_location' => $this->current_location,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
