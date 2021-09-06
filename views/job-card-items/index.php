<?php

use app\models\JobCard;
use app\models\JobCardItemsSearch;
use app\models\Users;
use kartik\checkbox\CheckboxX;
use kartik\grid\GridView as GridView2;
use lo\widgets\modal\ModalAjax;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

echo ModalAjax::widget([
    'id' => 'my-ajax',
    'selector' => '.my-ajax', // all buttons in grid view with href attribute
    'options' => ['class' => '', 'tabindex' => false],
    'autoClose' => true,
]);

/* @var $this View */
/* @var $searchModel JobCardItemsSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Job Card Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-card-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
//        Html::a('Create Job Card Items', ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php
    // echo $this->render('_search', ['model' => $searchModel]);

    $user = Users::findOne(["id" => Yii::$app->user->id]);

    $temp = "";

    if (Users::isServiceRole()) {

        $temp = "{update}";
    }
    ?>

    <?=
    GridView2::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'job_card_id',
                'width' => '310px',
//                'value' => function ($model, $key, $index, $widget) {
//                    return $model->id;
//                },
                'filterType' => GridView2::FILTER_SELECT2,
                'filter' => ArrayHelper::map(JobCard::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Job Card Id'],
                'group' => true, // enable grouping
            ],
//            'id',
//            'job_card_id',
//            'item_',
            ['label' => 'Item Name',
                'attribute' => 'item.name'],
            'cost',
            [
                'attribute' => 'warranty',
                'label' => 'warranty',
                'format' => 'raw',
                'value' => function($model) {
//                        return $model->is_paid == 0 ? 'غير مدفوع' : 'مدفوع';
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
            ['label' => 'Status',
                'attribute' => 'status0.name'],
            ['label' => 'Current Location',
                'attribute' => 'currentLocation.name'],
            'description:ntext',
            [
                'contentOptions' => ['style' => 'width:200px;'],
                'header' => "Actions",
                'class' => ActionColumn::class,
                'template' => $temp,
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open "></span>', ['/job-card/view2', 'id' => $model->id], [
                                    'class' => 'btn btn-primary btn-xs my-ajax',
                                    'style' => ' background-color: #20507B ',
                                    'title' => 'edit'
                        ]);
                    },
                    'recieve' => function ($url, $model) {
                        $urlsend = null;

                        $user = Users::findOne(["id" => Yii::$app->user->id]);
                        if (Users::isBranchRole()) {

                            $urlsend = "/job-card/recieve-from-service";
                            return Html::a('<span class=" glyphicon glyphicon-inbox "></span>', [$urlsend, 'id' => $model->id], [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #32CD30 ',
                                        'title' => 'Recieve from ServiceCenter',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
                                            'title' => Yii::t('app', 'Confirmation'),
                                            'ok' => Yii::t('app', 'OK'),
                                            'cancel' => Yii::t('app', 'Cancel'),
                                        ]
                            ]);
                        } elseif (Users::isServiceRole()) {
                            $urlsend = "/job-card/recieve-from-branch";
                            return Html::a('<span class="glyphicon glyphicon-inbox"></span>', [$urlsend, 'id' => $model->id], [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #337ab7 ',
                                        'title' => 'Recieve from Branch',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
                                            'title' => Yii::t('app', 'Confirmation'),
                                            'ok' => Yii::t('app', 'OK'),
                                            'cancel' => Yii::t('app', 'Cancel'),
                                        ]
                            ]);
                        }
                    },
                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
