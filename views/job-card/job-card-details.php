<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<?php $form = ActiveForm::begin(['id' => 'job-card-details-form']); ?>


<?= $form->field($model, 'job_card_id')->textInput(['autofocus' => true]) ?>


<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php
if ($model) {
    echo 'fe data';
} else {
    echo 'ma fe data';
}
?>