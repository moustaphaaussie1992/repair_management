<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('rbac-admin', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="portlet box bg-red col-md-6 col-md-offset-3">

    <div class="portlet-title">
        <div class="caption">
            <?= Html::encode($this->title) ?>
        </div>
    </div>

    <div class="portlet-body">
        <!--<p class="bold">Please fill out the following fields to change password:</p>-->


        <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>

        <?= $form->field($model, 'oldPassword')->passwordInput() ?>

        <?= $form->field($model, 'newPassword')->passwordInput() ?>

        <?= $form->field($model, 'retypePassword')->passwordInput() ?>

        <?= $form->errorSummary($model); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('rbac-admin', 'Change'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
