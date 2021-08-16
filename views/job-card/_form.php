<?php

use app\models\Branch;
use app\models\Customer;
use app\models\Item;
use app\models\JobCard;
use app\models\Location;
use app\models\Status;
use app\models\WarrantyType;
use kartik\checkbox\CheckboxX;
use kartik\widgets\Select2;
use richardfan\widget\JSRegister;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model JobCard */
/* @var $form ActiveForm */
?>

<div class="job-card-form">

    <?php $form = ActiveForm::begin(); ?>



    <?=
    $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Customer::find()->all(), 'id', function($model) {
                    return $model['name'] . "/" . $model['phone'];
                }),
        'options' => [
//            'id' => 'test',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Customer");
    ?>


    <?=
    $form->field($model, 'branch_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Branch::find()->all(), 'id', function($model) {
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
    ])->label("Branch");
    ?>

    <?=
    $form->field($model, 'item_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Item::find()->all(), 'id', function($model) {
                    return $model['name'] . "/" . $model['code'];
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
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?=
    $form->field($model, 'warranty')->widget(CheckboxX::classname(), ['options' => [
            'id' => 'test'],
        'pluginOptions' => ['threeState' => false]]);
    ?>


    <?=
    $form->field($model, 'warranty_type')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(WarrantyType::find()->all(), 'id', function($model) {
                    return $model['name'];
                }),
        'options' => [
            'id' => 'warranty-type',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Warranty Type");
    ?>









    <?=
    $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Status::find()->all(), 'id', function($model) {
                    return $model['name'];
                }),
        'options' => [
//            'id' => 'warranty-type',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Status");
    ?>
    <?=
    $form->field($model, 'current_location')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Location::find()->all(), 'id', function($model) {
                    return $model['name'];
                }),
        'options' => [
//            'id' => 'warranty-type',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Current Location");
    ?>




    <?= $form->field($model, 'cost')->textInput() ?>

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

    var x = document.getElementById("warranty-type");
    x.style.display = "none";
    $('#test').on('change', function () {
//        alert();
        if ($(this).is(':checked')) {
            alert();
        } else {

            x.style.display = "none";
        }
    });
</script>
<?php
JSRegister::end();

//Pjax::end();
?>
