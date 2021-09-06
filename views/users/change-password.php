<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('rbac-admin', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="portlet box col-md-6 ">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to Reset Password:</p>

    <div class="portlet-body">
        <!--<p class="bold">Please fill out the following fields to change password:</p>-->


        <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>

        <?= $form->field($model, 'oldPassword')->passwordInput() ?>

        <?= $form->field($model, 'newPassword')->passwordInput() ?>

        <?= $form->field($model, 'retypePassword')->passwordInput() ?>

        <?= $form->errorSummary($model); ?>



        <div class="form-group">
            <div class=" col-lg-11">
                <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'Change-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
