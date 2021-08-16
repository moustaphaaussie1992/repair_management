<?php

use app\models\Customer;
use app\models\Salesman;
use app\models\Social;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Customer */
/* @var $form ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


    <?=
    $form->field($model, 'salesman')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Salesman::find()->all(), 'id', function($model) {
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
    ])->label("Salesman");
    ?>

    <?=
    $form->field($model, 'know_us_from')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Social::find()->all(), 'id', function($model) {
                    return $model['name'];
                }),
        'options' => [
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Know Us From");
    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
