<?php

use app\models\Users;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Users */

$this->title = 'Update Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([Users::STATUS_ACTIVE => 'Active', Users::STATUS_INACTIVE => 'Inactive',]) ?>

    <?= $form->field($model, 'role')->dropDownList(Users::getRoles()) ?>

    <?= $form->field($model, 'c_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_phone')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
