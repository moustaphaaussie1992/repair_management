<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_card".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $branch_id
 * @property int $item_id
 * @property int|null $cost
 * @property int $warranty
 * @property int|null $warranty_type
 * @property int $status
 * @property int $current_location
 * @property string $description
 *
 * @property Branch $branch
 * @property Location $currentLocation
 * @property Customer $customer
 * @property Item $item
 * @property Status $status0
 * @property WarrantyType $warrantyType
 */
class JobCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'branch_id', 'item_id', 'status', 'current_location', 'description'], 'required'],
            [['customer_id', 'branch_id', 'item_id', 'cost', 'warranty', 'warranty_type', 'status', 'current_location'], 'integer'],
            [['description'], 'string'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['current_location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['current_location' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status' => 'id']],
            [['warranty_type'], 'exist', 'skipOnError' => true, 'targetClass' => WarrantyType::className(), 'targetAttribute' => ['warranty_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'branch_id' => 'Branch ID',
            'item_id' => 'Item ID',
            'cost' => 'Cost',
            'warranty' => 'Warranty',
            'warranty_type' => 'Warranty Type',
            'status' => 'Status',
            'current_location' => 'Current Location',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * Gets query for [[CurrentLocation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'current_location']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[WarrantyType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarrantyType()
    {
        return $this->hasOne(WarrantyType::className(), ['id' => 'warranty_type']);
    }
}
