<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salesman".
 *
 * @property int $id
 * @property string $name
 * @property int $branch
 *
 * @property Branch $branch0
 * @property Customer[] $customers
 */
class Salesman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salesman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'branch'], 'required'],
            [['branch'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['branch'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch' => 'id']],
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
            'branch' => 'Branch',
        ];
    }

    /**
     * Gets query for [[Branch0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch0()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['salesman' => 'id']);
    }
}
