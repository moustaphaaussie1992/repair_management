<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subsubfamily".
 *
 * @property int $id
 * @property int $name
 * @property int $subfamily
 *
 * @property Subfamily $subfamily0
 */
class Subsubfamily extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'subsubfamily';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'subfamily'], 'required'],
            [['subfamily'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['subfamily'], 'exist', 'skipOnError' => true, 'targetClass' => Subfamily::className(), 'targetAttribute' => ['subfamily' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'subfamily' => 'Subfamily',
        ];
    }

    /**
     * Gets query for [[Subfamily0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubfamily0() {
        return $this->hasOne(Subfamily::className(), ['id' => 'subfamily']);
    }

}
