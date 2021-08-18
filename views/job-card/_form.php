<?php

use app\models\Branch;
use app\models\Customer;
use app\models\JobCard;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'New Job Card';

/* @var $this View */
/* @var $model JobCard */
/* @var $form ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>


<div class="job-card-items-create">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">


                <h1><?= Html::encode($this->title) ?></h1>

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
                <div class="form-group">
                    <?= Html::a('Add Item', ['job-card-items/create'], ['class' => 'btn btn-danger']) ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
                </div>

            </div>
        </div>


        <div class="job-card-items-index">



            <?php Pjax::begin(); ?>


            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'job_card_id',
                    'item_id',
                    'cost',
                    'warranty',
                    'warranty_type',
                    'status',
                    'current_location',
                    'description:ntext',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>

            <?php Pjax::end(); ?>

        </div>

    </div>





    <?php ActiveForm::end(); ?>

</div>
