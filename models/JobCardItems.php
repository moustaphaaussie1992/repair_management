<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_card_items".
 *
 * @property int $id
 * @property int $job_card_id
 * @property int $item_id
 * @property int $cost
 * @property int $warranty
 * @property int $warranty_type
 * @property int $status
 * @property int $current_location
 * @property string $description
 * @property int|null $is_confirmed
 * @property int $email_sent
 * @property Location $currentLocation
 * @property Item $item
 * @property JobCard $jobCard
 * @property Status $status0
 * @property WarrantyType $warrantyType
 */
class JobCardItems extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'job_card_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['job_card_id', 'item_id', 'warranty', 'status', 'current_location', 'description'], 'required'],
            [['job_card_id', 'item_id', 'cost', 'warranty', 'warranty_type', 'status', 'current_location', 'is_confirmed', 'email_sent'], 'integer'],
            [['description'], 'string'],
            [['job_card_id', 'item_id'], 'unique', 'targetAttribute' => ['job_card_id', 'item_id']],
            [['job_card_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobCard::className(), 'targetAttribute' => ['job_card_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['current_location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['current_location' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status' => 'id']],
            [['warranty_type'], 'exist', 'skipOnError' => true, 'targetClass' => WarrantyType::className(), 'targetAttribute' => ['warranty_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'job_card_id' => 'Job Card ID',
            'item_id' => 'Item ID',
            'cost' => 'Cost',
            'warranty' => 'Warranty',
            'warranty_type' => 'Warranty Type',
            'status' => 'Status',
            'current_location' => 'Current Location',
            'description' => 'Description',
            'is_confirmed' => 'Is Confirmed',
            'email_sent' => 'Email Sent',
        ];
    }

    /**
     * Gets query for [[CurrentLocation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentLocation() {
        return $this->hasOne(Location::className(), ['id' => 'current_location']);
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem() {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * Gets query for [[JobCard]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobCard() {
        return $this->hasOne(JobCard::className(), ['id' => 'job_card_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0() {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[WarrantyType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarrantyType() {
        return $this->hasOne(WarrantyType::className(), ['id' => 'warranty_type']);
    }

}
