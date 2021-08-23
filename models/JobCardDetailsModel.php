<?php

namespace app\models;

use yii\base\Model;

class JobCardDetailsModel extends Model {

    public $job_card_id;

    public function rules() {
        return [
            [['job_card_id'], 'required'],
            [['job_card_id'], 'integer'],
        ];
    }

}
