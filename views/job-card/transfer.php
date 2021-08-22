<?php

use app\models\JobCardSearch;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

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

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['label' => 'Job Card',
                'attribute' => 'id'],
            [
                'class' => DataColumn::className(),
                'label' => 'Customer',
                'attribute' => 'customer_id',
                'value' => function ($model) {
                    if ($rel = $model->customer) {
                        return Html::a($rel->name, ['customer/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => DataColumn::className(),
                'label' => 'Branch',
                'attribute' => 'branch_id',
                'value' => function ($model) {
                    if ($rel = $model->branch) {
                        return Html::a($rel->name, ['branch/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'contentOptions' => ['style' => 'width:200px;'],
                'header' => "Actions",
                'class' => ActionColumn::class,
                'template' => '{update} {delete}{send}{recieve}{view}',
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
                    'send' => function ($url, $model) {
                        $urlsend = null;

                        $user = Users::findOne(["id" => Yii::$app->user->id]);
                        if (Users::isBranchRole()) {

                            $urlsend = "controllers/job-card/send-to-center";
                            return Html::a('<span class="glyphicon glyphicon-send "></span>', $urlsend, [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #32CD30 ',
                                        'title' => 'Send to ServiceCenter'
                            ]);
                        } elseif (Users::isServiceRole()) {
                            $urlsend = "controllers/job-card/send-to-branch";
                            return Html::a('<span class="glyphicon glyphicon-send "></span>', $urlsend, [
                                        'class' => 'btn btn-primary btn-xs my-ajax',
                                        'style' => ' background-color: #32CD30 ',
                                        'title' => 'Send to Branch'
                            ]);
                        }
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn btn-primary btn-xs my-ajax',
                                    'style' => ' background-color: #36c6d3 ',
                                    'title' => 'view'
                        ]);
                    },
//                    'recieve' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-send "></span>', $url, [
//                                    'class' => 'btn btn-primary btn-xs my-ajax',
//                                    'style' => ' background-color: #32CD30 ',
//                                    'title' => 'Recieve From Branch'
//                        ]);
//                    },
                ]
            ],
        ],
    ]);
    ?>
    <p>
        <?= Html::a('Send to Service Center', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::end(); ?>

</div>
