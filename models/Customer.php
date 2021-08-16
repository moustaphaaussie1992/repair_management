<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $salesman
 * @property int $know_us_from
 *
 * @property JobCard[] $jobCards
 * @property Social $knowUsFrom
 * @property Salesman $salesman0
 */
class Customer extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'email', 'phone', 'salesman', 'know_us_from'], 'required'],
            [['salesman', 'know_us_from'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            ['email', 'email'],
            ['phone', 'integer'],
            [['name', 'phone'], 'unique', 'targetAttribute' => ['name', 'phone']],
            [['salesman'], 'exist', 'skipOnError' => true, 'targetClass' => Salesman::className(), 'targetAttribute' => ['salesman' => 'id']],
            [['know_us_from'], 'exist', 'skipOnError' => true, 'targetClass' => Social::className(), 'targetAttribute' => ['know_us_from' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'salesman' => 'Salesman',
            'know_us_from' => 'Know Us From',
        ];
    }

    /**
     * Gets query for [[JobCards]].
     *
     * @return ActiveQuery
     */
    public function getJobCards() {
        return $this->hasMany(JobCard::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[KnowUsFrom]].
     *
     * @return ActiveQuery
     */
    public function getKnowUsFrom() {
        return $this->hasOne(Social::className(), ['id' => 'know_us_from']);
    }

    /**
     * Gets query for [[Salesman0]].
     *
     * @return ActiveQuery
     */
    public function getSalesman0() {
        return $this->hasOne(Salesman::className(), ['id' => 'salesman']);
    }

}
