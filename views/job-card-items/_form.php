<?php

use app\models\Item;
use app\models\JobCardItems;
use app\models\Status;
use app\models\Users;
use app\models\WarrantyType;
use kartik\checkbox\CheckboxX;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model JobCardItems */
/* @var $form ActiveForm */
?>

<div class="job-card-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'job_card_id')->textInput() ?>


    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $form->field($model, 'item_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Item::find()->all(), 'id', function($model) {
                    return $model['code'] . "/" . $model['name'];
                }),
        'options' => [
//            'id' => 'test',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Item");
    ?>



    <?=
    $form->field($model, 'warranty')->widget(CheckboxX::className(), [
//        'name' => 's_1',
//        'options' => ['id' => 's_1'],
        'pluginOptions' => ['threeState' => false]
    ]);
    ?>




    <?=
    $form->field($model, 'warranty_type')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(WarrantyType::find()->all(), 'id', function($model) {
                    return $model['name'];
                }),
        'options' => [
//            'id' => 'test',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Warranty Type");
    ?>

    <?php // $form->field($model, 'status')->textInput() ?>

    <?php // $form->field($model, 'current_location')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?php
    $user = Users::findOne(["id" => Yii::$app->user->id]);

    if (Users::isServiceRole()) {
        echo $form->field($model, 'cost')->textInput();
        echo $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Status::find()->all(), 'id', function($model) {
                        return $model['name'];
                    }),
            'options' => [
//            'id' => 'test',
                'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("Status");
    }
    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
