<?php

use app\models\JobCard;
use app\models\JobCardSearch;
use app\models\Users;
use kartik\checkbox\CheckboxX;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\grid\GridView as GridView2;

/* @var $this View */
/* @var $searchModel JobCardSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Send Items To Center';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-card-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['label' => 'Job Card',
//                'attribute' => 'id'],
//            [
//                'class' => DataColumn::className(),
//                'label' => 'Customer',
//                'attribute' => 'customer_id',
//                'value' => function ($model) {
//                    if ($rel = $model->customer) {
//                        return Html::a($rel->name, ['customer/view', 'id' => $rel->id,], ['data-pjax' => 0]);
//                    } else {
//                        return '';
//                    }
//                },
//                'format' => 'raw',
//            ],
//            [
//                'class' => DataColumn::className(),
//                'label' => 'Branch',
//                'attribute' => 'branch_id',
//                'value' => function ($model) {
//                    if ($rel = $model->branch) {
//                        return Html::a($rel->name, ['branch/view', 'id' => $rel->id,], ['data-pjax' => 0]);
//                    } else {
//                        return '';
//                    }
//                },
//                'format' => 'raw',
//            ],
//            [
//                'contentOptions' => ['style' => 'width:200px;'],
//                'header' => "Actions",
//                'class' => ActionColumn::class,
//                'template' => '{update} {delete}{send}{recieve}{view}',
//                'buttons' => [
//                    'update' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil "></span>', ['/job-card-items/update', 'id' => $model->id], [
//                                    'class' => 'btn btn-primary btn-xs my-ajax',
//                                    'style' => ' background-color: #20507B ',
//                                    'title' => 'edit'
//                        ]);
//                    },
//                    'delete' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/job-card-items/delete', 'id' => $model->id], [
//                                    'class' => 'btn btn-danger btn-xs',
//                                    'style' => ' background-color: #ba5754 ',
//                                    'data' => [
//                                        'method' => 'post',
//                                        'params' => [
//                                            'id' => $model->id
//                                        ],
//                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                                        'title' => Yii::t('app', 'Confirmation'),
//                                        'ok' => Yii::t('app', 'OK'),
//                                        'cancel' => Yii::t('app', 'Cancel'),
//                                    ]
//                        ]);
//                    },
//                    'send' => function ($url, $model) {
//                        $urlsend = null;
//
//                        $user = Users::findOne(["id" => Yii::$app->user->id]);
//                        if (Users::isBranchRole()) {
//
//                            $urlsend = "controllers/job-card/send-to-center";
//                            return Html::a('<span class="glyphicon glyphicon-send "></span>', $urlsend, [
//                                        'class' => 'btn btn-primary btn-xs my-ajax',
//                                        'style' => ' background-color: #32CD30 ',
//                                        'title' => 'Send to ServiceCenter'
//                            ]);
//                        } elseif (Users::isServiceRole()) {
//                            $urlsend = "controllers/job-card/send-to-branch";
//                            return Html::a('<span class="glyphicon glyphicon-send "></span>', $urlsend, [
//                                        'class' => 'btn btn-primary btn-xs my-ajax',
//                                        'style' => ' background-color: #32CD30 ',
//                                        'title' => 'Send to Branch'
//                            ]);
//                        }
//                    },
//                    'view' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//                                    'class' => 'btn btn-primary btn-xs my-ajax',
//                                    'style' => ' background-color: #36c6d3 ',
//                                    'title' => 'view'
//                        ]);
//                    },
////                    'recieve' => function ($url, $model) {
////                        return Html::a('<span class="glyphicon glyphicon-send "></span>', $url, [
////                                    'class' => 'btn btn-primary btn-xs my-ajax',
////                                    'style' => ' background-color: #32CD30 ',
////                                    'title' => 'Recieve From Branch'
////                        ]);
////                    },
//                ]
//            ],
//        ],
//    ]);
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
                'template' => '{send}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open "></span>', ['/job-card/view2', 'id' => $model->id], [
                                    'class' => 'btn btn-primary btn-xs my-ajax',
                                    'style' => ' background-color: #20507B ',
                                    'title' => 'edit'
                        ]);
                    },
                    'send' => function ($url, $model) {
                        $urlsend = null;

                        $user = Users::findOne(["id" => Yii::$app->user->id]);
                        if (Users::isBranchRole()) {

                            $urlsend = "/job-card/send-to-center";
                            return Html::a('<span class="glyphicon glyphicon-send "></span>', [$urlsend, 'id' => $model->id], [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #32CD30 ',
                                        'title' => 'Send to ServiceCenter',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to Send this item?'),
                                            'title' => Yii::t('app', 'Confirmation'),
                                            'ok' => Yii::t('app', 'OK'),
                                            'cancel' => Yii::t('app', 'Cancel'),
                                        ]
                            ]);
                        } elseif (Users::isServiceRole()) {
                            $urlsend = "/job-card/send-to-branch";
                            return Html::a('<span class="glyphicon glyphicon-send "></span>', [$urlsend, 'id' => $model->id], [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #32CD30 ',
                                        'title' => 'Send to Branch',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to Send this item?'),
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
    <p>
        <?php //        Html::a('Send to Service Center', ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?php Pjax::end(); ?>

</div>
