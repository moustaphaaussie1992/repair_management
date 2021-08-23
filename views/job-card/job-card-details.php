<?php

use kartik\checkbox\CheckboxX;
use yii\grid\GridView;
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


    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'job_card_id',
            ['label' => 'Item Name',
                'attribute' => 'item.name'],
            'cost',
            [
                'attribute' => 'warranty',
                'label' => 'Warranty',
                'format' => 'raw',
                'value' => function($model) {
//
                    return $model->warranty == 0 ? '<span class="glyphicon glyphicon-remove" style="color:red;"></span>' : '<span class="glyphicon glyphicon-ok" style="color:green;"></span>';
                },
                'filter' => CheckboxX::widget([
                    'model' => $searchModel,
                    'attribute' => 'warranty',
                    'pluginOptions' => ['threeState' => true]
                ]),
            ],
            ['label' => 'Warranty Type',
                'attribute' => 'warrantyType.name'],
            ['label' => 'Current Status',
                'attribute' => 'status0.name'],
            ['label' => 'Current Location',
                'attribute' => 'currentLocation.name'],
            'description:ntext',
        ],
    ]);
} else {
    echo 'ma fe data';
}
?>