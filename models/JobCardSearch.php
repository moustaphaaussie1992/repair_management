<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobCard;

/**
 * JobCardSearch represents the model behind the search form of `app\models\JobCard`.
 */
class JobCardSearch extends JobCard {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'done'], 'integer'],
            [['customer_id', 'branch_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = JobCard::find()
                ->joinWith('branch')
                ->joinWith('customer');


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
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'branch.name', $this->branch_id]);

        return $dataProvider;
    }

    public function readysearch($params) {
        $query = JobCard::find()
                ->joinWith('branch')
                ->joinWith('customer')
                ->where(['done' => 1]);


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
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'branch.name', $this->branch_id]);

        return $dataProvider;
    }

    public function needfixsearch($params) {
        $query = JobCard::find()
                ->joinWith('branch')
                ->joinWith('customer')
                ->where(['done' => 0]);


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
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'branch.name', $this->branch_id]);

        return $dataProvider;
    }

}
