<?php

use app\models\
Family; use app\models\Item;
use
app \models\Subfamily;
use app \models\Subsubfamily;
use kartik\widgets \Select2;
use yii\helpers\

ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Item */
        /* @var $form ActiveForm */
?>

        <div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput([ 'maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true ]) ?>

            <?=
            $form->field($model, 'family')->widget(Select2::classname(), [
                 'data' => ArrayHelper::map(Family::find()->all(), 'id', function($model) {
        return $model['name'] . "/" . $model['code'];
            }),
                    'options'  => [
//            'id' => 'test',
        'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' =>  true
                    ],
            ])->label("Family");

                    ?>
                    <?=
                    $form->field($model, 'subfamily')->widget(Select2::classname(), [
                         'data' => ArrayHelper::map(Subfamily::find()->all(), 'id', function( $model) {
                return $model['name'];
                    }),
                            'options'  => [
//            'id' => 'test',
                'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
                ],
                'pluginOptions' => [
            'allowClear' =>  true
            ],
    ])->label("Sub Family");
            ?>
            <?=
            $form->field($model, 'subsubfamily')->widget(Select2::classname(), [
                 'data' => ArrayHelper::map(Subsubfamily::find()->all(), 'id', function( $model) {
        return $model['name'];
            }),
                    'options'  => [
//            'id' => 'test',
        'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
    ],
    ])->label("Sub Sub Family");

            ?>




            <div class="form-group">
        <?=
        Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
