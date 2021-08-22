<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "job_card".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $branch_id
 * @property int $done
 * @property int $current_location
 *
 * @property Branch $branch
 * @property Customer $customer
 * @property Item[] $items
 * @property JobCardItems[] $jobCardItems
 */
class JobCard extends ActiveRecord {

    const LOCATION_BRANCH = '1';
    const LOCATION_SENT_TO_SERVICE = '2';
    const LOCATION_SERVICE = '3';
    const LOCATION_SENT_TO_BRANCH = '4';
    const STATUS_UNDER_REPAIR = '1';
    const STATUS_FIXED = '2';
    const STATUS_UNFIXABLE = '3';

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'job_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['customer_id', 'branch_id', 'current_location'], 'required'],
            [['customer_id', 'branch_id', 'done', 'current_location'], 'integer'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'branch_id' => 'Branch ID',
            'done' => 'Done',
            'current_location' => 'Current Location',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return ActiveQuery
     */
    public function getBranch() {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return ActiveQuery
     */
    public function getCustomer() {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return ActiveQuery
     */
    public function getItems() {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('job_card_items', ['job_card_id' => 'id']);
    }

    /**
     * Gets query for [[JobCardItems]].
     *
     * @return ActiveQuery
     */
    public function getJobCardItems() {
        return $this->hasMany(JobCardItems::className(), ['job_card_id' => 'id']);
    }

}
