<?php

namespace app\models;

use app\models\JobCardItems;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * JobCardItemsSearch represents the model behind the search form of `app\models\JobCardItems`.
 */
class JobCardItemsSearch extends JobCardItems {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'job_card_id', 'item_id', 'cost', 'warranty', 'warranty_type', 'status', 'current_location'], 'integer'],
            [['description'], 'safe'],
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

    public function mysearch($params, $id) {

        $user = Users::findOne(["id" => Yii::$app->user->id]);





        $query = JobCardItems::find()->where(['job_card_id' => $id]);


        if (Users::isBranchRole()) {



            $query->andWhere(['current_location' => JobCard::LOCATION_BRANCH]);
        }
        if (Users::isServiceRole()) {



            $query->andWhere(['current_location' => JobCard::LOCATION_SERVICE]);
        }






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

    public function mysearch2($params, $id) {

        $user = Users::findOne(["id" => Yii::$app->user->id]);





        $query = JobCardItems::find()->where(['job_card_id' => $id]);


        if (Users::isBranchRole()) {



            $query->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_BRANCH]);
        }
        if (Users::isServiceRole()) {



            $query->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_SERVICE]);
        }






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

    public function needfixsearch($params) {

        $user = Users::findOne(["id" => Yii::$app->user->id]);





        $query = JobCardItems::find()
                ->joinWith('jobCard');


        if (Users::isBranchRole()) {

            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_BRANCH]);

            $query->andWhere(['job_card.branch_id' => $user->branch]);
            $query->andWhere(['status' => 1]);
        }
        if (Users::isServiceRole()) {



            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_SERVICE]);
            $query->andWhere(['status' => 1]);
        }






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

    public function transfersearch($params) {

        $user = Users::findOne(["id" => Yii::$app->user->id]);





        $query = JobCardItems::find()
                ->joinWith('jobCard');


        if (Users::isBranchRole()) {

            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_BRANCH]);

            $query->andWhere(['job_card.branch_id' => $user->branch]);
            $query->andWhere(['status' => 1]);
        }
        if (Users::isServiceRole()) {



            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_SERVICE])
                    ->andWhere(['!=', 'job_card_items.status', 1]);
        }






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

    public function recievesearch($params) {

        $user = Users::findOne(["id" => Yii::$app->user->id]);





        $query = JobCardItems::find()
                ->joinWith('jobCard');


        if (Users::isBranchRole()) {

            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_SENT_TO_BRANCH]);

            $query->andWhere(['job_card.branch_id' => $user->branch]);
        }
        if (Users::isServiceRole()) {



            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_SENT_TO_SERVICE]);
        }






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

    public function readysearch($params) {

        $user = Users::findOne(["id" => Yii::$app->user->id]);





        $query = JobCardItems::find()
                ->joinWith('jobCard');


        if (Users::isBranchRole()) {


            $query
                    ->andWhere(['!=', 'job_card_items.status', 1]);
            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_BRANCH]);

            $query->andWhere(['job_card.branch_id' => $user->branch]);
        }
        if (Users::isServiceRole()) {


            $query
                    ->andWhere(['!=', 'job_card_items.status', 1]);
            $query->andWhere(['job_card_items.current_location' => JobCard::LOCATION_SERVICE]);
        }






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
