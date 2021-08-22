<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subfamily".
 *
 * @property int $id
 * @property string $name
 * @property int $family
 *
 * @property Family $family0
 * @property Subsubfamily[] $subsubfamilies
 */
class Subfamily extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'subfamily';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'family'], 'required'],
            [['family'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['family'], 'exist', 'skipOnError' => true, 'targetClass' => Family::className(), 'targetAttribute' => ['family' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'family' => 'Family',
        ];
    }

    /**
     * Gets query for [[Family0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamily0() {
        return $this->hasOne(Family::className(), ['id' => 'family']);
    }

    /**
     * Gets query for [[Subsubfamilies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubsubfamilies() {
        return $this->hasMany(Subsubfamily::className(), ['subfamily' => 'id']);
    }

    public function getSubfamiliesbyfamily($family) {


        $subfamily = \app\models\Subfamily::find()
                ->select('*')
                ->where(['family' => $family])
                ->all();
        return $subfamily;
    }

}
