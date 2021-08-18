<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobCardItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-card-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_card_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'cost') ?>

    <?= $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'warranty_type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'current_location') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
