<?php

use app\models\JobCard;
use app\models\Users;
use kartik\checkbox\CheckboxX;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $model JobCard */

$this->title = "Job Card " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="job-card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            ['label' => 'Customer Name',
                'attribute' => 'customer.name'],
            ['label' => 'Branch Name',
                'attribute' => 'branch.name'],
            [
                'attribute' => 'done',
                'label' => 'Job Card Done ?',
                'format' => 'raw',
                'value' => function($model) {
//
                    return $model->done == 0 ? '<span class="glyphicon glyphicon-remove" style="color:red;"></span>' : '<span class="glyphicon glyphicon-ok" style="color:green;"></span>';
                },
            ],
        ],
    ])
    ?>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Add Item', ['job-card-items/create', 'job_card_id' => $model->id], ['class' => 'btn ',
            'style' => ' background-color: #32CD30; margin-top: 2px;color:white',
            'title' => Yii::t('app', 'Add Item')])
        ?>
    </p>

    <div class="job-card-items-index">
        <?=
        GridView::widget([
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
//                ['class' => 'yii\grid\ActionColumn'],
                [
                    'contentOptions' => ['style' => 'width:200px;'],
                    'header' => "Actions",
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}{send}{recieve}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil "></span>', ['/job-card-items/update', 'id' => $model->id], [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #20507B ',
                                        'title' => 'edit'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/job-card-items/delete', 'id' => $model->id], [
                                        'class' => 'btn btn-danger btn-xs',
                                        'style' => ' background-color: #ba5754 ',
                                        'data' => [
                                            'method' => 'post',
                                            'params' => [
                                                'id' => $model->id
                                            ],
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                            'title' => Yii::t('app', 'Confirmation'),
                                            'ok' => Yii::t('app', 'OK'),
                                            'cancel' => Yii::t('app', 'Cancel'),
                                        ]
                            ]);
                        },
//                        'send' => function ($url, $model) {
//                            $urlsend = null;
//
//                            $user = Users::findOne(["id" => Yii::$app->user->id]);
//                            if (Users::isBranchRole()) {
//
//                                $urlsend = "/job-card/send-to-center";
//                                return Html::a('<span class="glyphicon glyphicon-send "></span>', [$urlsend, 'id' => $model->id], [
//                                            'class' => 'btn btn-primary btn-xs my-ajax',
//                                            'style' => ' background-color: #32CD30 ',
//                                            'title' => 'Send to ServiceCenter',
//                                            'data' => [
//                                                'confirm' => Yii::t('app', 'Are you sure you want to Send this item?'),
//                                                'title' => Yii::t('app', 'Confirmation'),
//                                                'ok' => Yii::t('app', 'OK'),
//                                                'cancel' => Yii::t('app', 'Cancel'),
//                                            ]
//                                ]);
//                            } elseif (Users::isServiceRole()) {
//                                $urlsend = "/job-card/send-to-branch";
//                                return Html::a('<span class="glyphicon glyphicon-send "></span>', [$urlsend, 'id' => $model->id], [
//                                            'class' => 'btn btn-primary btn-xs my-ajax',
//                                            'style' => ' background-color: #32CD30 ',
//                                            'title' => 'Send to Branch',
//                                            'data' => [
//                                                'confirm' => Yii::t('app', 'Are you sure you want to Send this item?'),
//                                                'title' => Yii::t('app', 'Confirmation'),
//                                                'ok' => Yii::t('app', 'OK'),
//                                                'cancel' => Yii::t('app', 'Cancel'),
//                                            ]
//                                ]);
//                            }
//                        },
////                                actionRecieveFromBranch
//                        'recieve' => function ($url, $model) {
//                            $urlsend = null;
//
//                            $user = Users::findOne(["id" => Yii::$app->user->id]);
//                            if (Users::isBranchRole()) {
//
//                                $urlsend = "/job-card/recieve-from-service";
//                                return Html::a('<span class=" glyphicon glyphicon-inbox "></span>', [$urlsend, 'id' => $model->id], [
//                                            'class' => 'btn btn-primary btn-xs my-ajax',
//                                            'style' => ' background-color: #32CD30 ',
//                                            'title' => 'Recieve from ServiceCenter',
//                                            'data' => [
//                                                'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
//                                                'title' => Yii::t('app', 'Confirmation'),
//                                                'ok' => Yii::t('app', 'OK'),
//                                                'cancel' => Yii::t('app', 'Cancel'),
//                                            ]
//                                ]);
//                            } elseif (Users::isServiceRole()) {
//                                $urlsend = "/job-card/recieve-from-branch";
//                                return Html::a('<span class="glyphicon glyphicon-inbox"></span>', [$urlsend, 'id' => $model->id], [
//                                            'class' => 'btn btn-primary btn-xs my-ajax',
//                                            'style' => ' background-color: #337ab7 ',
//                                            'title' => 'Recieve from Branch',
//                                            'data' => [
//                                                'confirm' => Yii::t('app', 'Are you sure you want to Recieve this item?'),
//                                                'title' => Yii::t('app', 'Confirmation'),
//                                                'ok' => Yii::t('app', 'OK'),
//                                                'cancel' => Yii::t('app', 'Cancel'),
//                                            ]
//                                ]);
//                            }
//                        },
                    ]
                ],
            ],
        ]);
        ?>

    </div>

    <?php Pjax::end(); ?>

</div>
