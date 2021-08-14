<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $name
 *
 * @property JobCard[] $jobCards
 * @property Salesman[] $salesmen
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * Gets query for [[JobCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobCards()
    {
        return $this->hasMany(JobCard::className(), ['branch_id' => 'id']);
    }

    /**
     * Gets query for [[Salesmen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesmen()
    {
        return $this->hasMany(Salesman::className(), ['branch' => 'id']);
    }
}
