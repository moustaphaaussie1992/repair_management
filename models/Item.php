<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $family
 * @property int $subfamily
 * @property int $subsubfamily
 * @property int $brand_id
 *
 * @property Brand $brand
 * @property Family $family0
 * @property JobCardItems[] $jobCardItems
 * @property JobCard[] $jobCards
 * @property Subfamily $subfamily0
 * @property Subsubfamily $subsubfamily0
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'family', 'subfamily', 'subsubfamily', 'brand_id'], 'required'],
            [['family', 'subfamily', 'subsubfamily', 'brand_id'], 'integer'],
            [['name'], 'string', 'max' => 300],
            [['code'], 'string', 'max' => 100],
            [['family'], 'exist', 'skipOnError' => true, 'targetClass' => Family::className(), 'targetAttribute' => ['family' => 'id']],
            [['subfamily'], 'exist', 'skipOnError' => true, 'targetClass' => Subfamily::className(), 'targetAttribute' => ['subfamily' => 'id']],
            [['subsubfamily'], 'exist', 'skipOnError' => true, 'targetClass' => Subsubfamily::className(), 'targetAttribute' => ['subsubfamily' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'family' => 'Family',
            'subfamily' => 'Subfamily',
            'subsubfamily' => 'Subsubfamily',
            'brand_id' => 'Brand ID',
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * Gets query for [[Family0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamily0()
    {
        return $this->hasOne(Family::className(), ['id' => 'family']);
    }

    /**
     * Gets query for [[JobCardItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobCardItems()
    {
        return $this->hasMany(JobCardItems::className(), ['item_id' => 'id']);
    }

    /**
     * Gets query for [[JobCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobCards()
    {
        return $this->hasMany(JobCard::className(), ['id' => 'job_card_id'])->viaTable('job_card_items', ['item_id' => 'id']);
    }

    /**
     * Gets query for [[Subfamily0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubfamily0()
    {
        return $this->hasOne(Subfamily::className(), ['id' => 'subfamily']);
    }

    /**
     * Gets query for [[Subsubfamily0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubsubfamily0()
    {
        return $this->hasOne(Subsubfamily::className(), ['id' => 'subsubfamily']);
    }
}
