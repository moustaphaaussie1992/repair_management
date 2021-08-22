<?php

use app\models\Family;
use app\models\Item;
use kartik\widgets\Select2;
use richardfan\widget\JSRegister;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $model Item */
/* @var $form ActiveForm */
?>
<?php
Pjax::begin(['id' => 'pjax-id']);
?>


<div class="item-form">


    <?php
    $form = ActiveForm::begin([
                'id' => 'searchActiveForm',
                'action' => ['family-select'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'family')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Family::find()->all(), 'id', function($model) {
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
    ])->label("Family");
    ?>

    <?=
    $form->field($model, 'subfamily')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Subfamily::find()->all(), 'id', function($model) {
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
    ])->label("Sub Family");
    ?>
    <?=
    $form->field($model, 'subsubfamily')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Subsubfamily::find()->all(), 'id', function($model) {
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
    ])->label("Sub Sub Family");
    ?>
    <?=
    $form->field($model, 'brand_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Brand::find()->all(), 'id', function($model) {
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
    ])->label("Brand");
    ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
JSRegister::begin([
    'id' => '1',
    'position' => static::POS_END
]);
?>

<script>

//    $("#item-family").on("change", function () {
//        $("#item-subfamily").val("");
//        $("#item-subsubfamily").val("");
//        $('#searchActiveForm').yiiActiveForm('submitForm');
//    });
//
//
//
//    $("#item-subfamily").on("change", function () {
//        $("#item-subsubfamily").val("");
//        $('#searchActiveForm').yiiActiveForm('submitForm');
//    });





</script>
<?php
JSRegister::end();
Pjax::end();
?>


