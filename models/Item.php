<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $code
 * @property string $family
 * @property string $subfamily
 *
 * @property JobCard[] $jobCards
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
            [['code', 'family', 'subfamily'], 'required'],
            [['code', 'family', 'subfamily'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'family' => 'Family',
            'subfamily' => 'Subfamily',
        ];
    }

    /**
     * Gets query for [[JobCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobCards()
    {
        return $this->hasMany(JobCard::className(), ['item_id' => 'id']);
    }
}
