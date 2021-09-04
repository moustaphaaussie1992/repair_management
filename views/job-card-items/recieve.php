<?php

use app\models\JobCard;
use app\models\JobCardSearch;
use app\models\Users;
use kartik\checkbox\CheckboxX;
use kartik\grid\GridView as GridView2;
use richardfan\widget\JSRegister;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel JobCardSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Job Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-card-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

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
//                'attribute' => 'done',
//                'label' => 'done',
//                'format' => 'raw',
//                'value' => function($model) {
////                        return $model->is_paid == 0 ? 'غير مدفوع' : 'مدفوع';
//                    return $model->done == 0 ? '<span class="glyphicon glyphicon-remove" style="color:red;"></span>' : '<span class="glyphicon glyphicon-ok" style="color:green;"></span>';
//                },
//                'filter' => CheckboxX::widget([
//                    'model' => $searchModel,
//                    'attribute' => 'done',
//                    'pluginOptions' => ['threeState' => true]
//                ]),
//            ],
//            [
//                'contentOptions' => ['style' => 'width:200px;'],
//                'header' => "Actions",
//                'class' => ActionColumn::class,
//                'template' => '{view}',
//                'buttons' => [
//                    'view' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open "></span>', ['/job-card/view2', 'id' => $model->id], [
//                                    'class' => 'btn btn-primary btn-xs my-ajax',
//                                    'style' => ' background-color: #20507B ',
//                                    'title' => 'edit'
//                        ]);
//                    },
//                    'recieve' => function ($url, $model) {
//                        $urlsend = null;
//
//                        $user = Users::findOne(["id" => Yii::$app->user->id]);
//                        if (Users::isBranchRole()) {
//
//                            $urlsend = "/job-card/recieve-from-service";
//                            return Html::a('<span class=" glyphicon glyphicon-inbox "></span>', [$urlsend, 'id' => $model->id], [
//                                        'class' => 'btn btn-primary btn-xs my-ajax',
//                                        'style' => ' background-color: #32CD30 ',
//                                        'title' => 'Recieve from ServiceCenter',
//                                        'data' => [
//                                            'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
//                                            'title' => Yii::t('app', 'Confirmation'),
//                                            'ok' => Yii::t('app', 'OK'),
//                                            'cancel' => Yii::t('app', 'Cancel'),
//                                        ]
//                            ]);
//                        } elseif (Users::isServiceRole()) {
//                            $urlsend = "/job-card/recieve-from-branch";
//                            return Html::a('<span class="glyphicon glyphicon-inbox"></span>', [$urlsend, 'id' => $model->id], [
//                                        'class' => 'btn btn-primary btn-xs my-ajax',
//                                        'style' => ' background-color: #337ab7 ',
//                                        'title' => 'Recieve from Branch',
//                                        'data' => [
//                                            'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
//                                            'title' => Yii::t('app', 'Confirmation'),
//                                            'ok' => Yii::t('app', 'OK'),
//                                            'cancel' => Yii::t('app', 'Cancel'),
//                                        ]
//                            ]);
//                        }
//                    },
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
                'template' => '{recieve}',
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
//                        if (Users::isBranchRole()) {
///////////////honn bdde edb3at l model->id
//                            $urlsend = "/job-card/recieve-from-service";
//                            return Html::a(' <span class=" glyphicon glyphicon-inbox "></span>', [$urlsend, 'id' => $model->id], [
//                                        'class' => 'btn btn-primary btn-xs my-ajax',
//                                        'style' => ' background-color: #32CD30 ',
//                                        'id' => 'recieve-button',
//                                        'title' => 'Recieve from ServiceCenter',
//                                        'data' => [
//                                            'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
//                                            'title' => Yii::t('app', 'Confirmation'),
//                                            'ok' => Yii::t('app', 'OK'),
//                                            'cancel' => Yii::t('app', 'Cancel'),
//                                        ]
//                            ]);
//                        } elseif (Users::isServiceRole()) {
//                            $urlsend = "/job-card/recieve-from-branch";
//                            return Html::a('<span class="glyphicon glyphicon-inbox"></span>', [$urlsend, 'id' => $model->id], [
//                                        'class' => 'btn btn-primary btn-xs my-ajax',
//                                        'style' => ' background-color: #337ab7 ',
//                                        'title' => 'Recieve from Branch',
//                                        'data' => [
//                                            'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
//                                            'title' => Yii::t('app', 'Confirmation'),
//                                            'ok' => Yii::t('app', 'OK'),
//                                            'cancel' => Yii::t('app', 'Cancel'),
//                                        ]
//                            ]);
//                        }
                        if (Users::isBranchRole()) {
/////////////honn bdde edb3at l model->id
                            $urlsend = "/job-card/recieve-from-service";
                            return Html::a('<span class=" glyphicon glyphicon-inbox "></span>', null, [
                                        'class' => 'btn btn-primary btn-xs my-ajax recieve-from-service-button',
                                        'style' => ' background-color: #32CD30 ',
                                        'calss' => 'recieve-button',
                                        'title' => 'Recieve from Service Center',
                                        'itemId' => $model->id
                            ]);
                        } elseif (Users::isServiceRole()) {
                            $urlsend = "/job-card/recieve-from-branch";
                            return Html::a('<span class="glyphicon glyphicon-inbox"></span>', null, [
                                        'class' => 'btn btn-primary btn-xs my-ajax recieve-from-branch-button',
                                        'style' => ' background-color: #337ab7 ',
                                        'title' => 'Recieve from Branch',
                                        'itemId' => $model->id
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


<?php
JSRegister::begin([
    'id' => '1',
    'position' => static::POS_END
]);
?>

<script>

    $(".recieve-from-service-button").on('click', function () {

        var txt;
        var r = confirm("Are You Sure!");
        if (r == true) {
            var id = $(this).attr("itemId");
            var url = '<?= Url::toRoute("job-card/recieve-from-service") ?>';
//        alert(id);
//        return;
//        alert(request.getParameter("action"); );
//        var result = confirm("هل أنت متأكد؟");
//        if (result) {
//w hon bdde b3ataa lal api
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: id, ///ah sa7 jarrabet ra2em 3ade raddet error
                },
                success: function (data) {
                    console.log(data);
                    if (data["success"] == true) {
                        alert(data["message"]);
                    } else {
                        console.log(data["message"]);
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
//        }

//        $message = Yii::$app->twilio->sms('+96181756788', 'Hello World! sssss');

        } else {

        }

    });

    $(".recieve-from-branch-button").on('click', function () {

        var txt;
        var r = confirm("Are You Sure!");
        if (r == true) {
            var id = $(this).attr("itemId");
            var url = '<?= Url::toRoute("job-card/recieve-from-branch") ?>';
//        alert(id);
//        return;
//        alert(request.getParameter("action"); );
//        var result = confirm("هل أنت متأكد؟");
//        if (result) {
//w hon bdde b3ataa lal api
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: id, ///ah sa7 jarrabet ra2em 3ade raddet error
                },
                success: function (data) {
                    console.log(data);
                    if (data["success"] == true) {
                        alert(data["message"]);
                    } else {
                        console.log(data["message"]);
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
//        }

//        $message = Yii::$app->twilio->sms('+96181756788', 'Hello World! sssss');

        } else {

        }

    });

</script>

<?php
JSRegister::end();
?>
