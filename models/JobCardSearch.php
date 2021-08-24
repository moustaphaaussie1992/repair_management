<?php

namespace app\models;

use app\models\JobCard;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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

        $user = Users::findOne(["id" => Yii::$app->user->id]);
        $query = JobCard::find()
                ->joinWith('branch')
                ->joinWith('customer');


        if (Users::isBranchRole()) {

            $branchid = $user->branch;

            $query->andWhere(['branch_id' => $branchid]);
            $query->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_BRANCH]);

//            $query->joinWith('jobCardItems')
//                    ->andWhere((['job_card_items.current_location' => JobCard::LOCATION_SENT_TO_BRANCH]));
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
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'branch.name', $this->branch_id]);

        return $dataProvider;
    }

    public function readysearch($params) {
        $user = Users::findOne(["id" => Yii::$app->user->id]);
        $query = JobCard::find()
                ->joinWith('branch')
                ->joinWith('customer')
                ->where(['done' => 1]);
        if (Users::isBranchRole()) {

            $branchid = $user->branch;

            $query->andWhere(['branch_id' => $branchid]);
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
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'branch.name', $this->branch_id]);

        return $dataProvider;
    }

    public function needfixsearch($params) {



        $user = Users::findOne(["id" => Yii::$app->user->id]);


        $query = JobCard::find()
                ->joinWith('branch')
                ->joinWith('customer')
                ->where(['done' => 0]);

        if (Users::isBranchRole()) {

            $branchid = $user->branch;

            $query->andWhere(['branch_id' => $branchid]);
            $query->andWhere(['current_location' => JobCard::LOCATION_BRANCH]);
        }

        if (Users::isServiceRole()) {

//            $query->andWhere(['current_location' => JobCard::LOCATION_SERVICE]);
            $query->joinWith('jobCardItems')
                    ->andWhere((['job_card_items.current_location' => JobCard::LOCATION_SERVICE]));
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
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'customer.name', $this->customer_id]);
        $query->andFilterWhere(['like', 'branch.name', $this->branch_id]);

        return $dataProvider;
    }

}
