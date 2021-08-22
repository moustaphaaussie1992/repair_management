<?php

use app\models\JobCardSearch;
use kartik\checkbox\CheckboxX;
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

$this->title = 'Job Cards';
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
                'attribute' => 'done',
                'label' => 'done',
                'format' => 'raw',
                'value' => function($model) {
//                        return $model->is_paid == 0 ? 'غير مدفوع' : 'مدفوع';
                    return $model->done == 0 ? '<span class="glyphicon glyphicon-remove" style="color:red;"></span>' : '<span class="glyphicon glyphicon-ok" style="color:green;"></span>';
                },
                'filter' => CheckboxX::widget([
                    'model' => $searchModel,
                    'attribute' => 'done',
                    'pluginOptions' => ['threeState' => true]
                ]),
            ],
            [
                'contentOptions' => ['style' => 'width:200px;'],
                'header' => "Actions",
                'class' => ActionColumn::class,
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open "></span>', ['/job-card/view2', 'id' => $model->id], [
                                    'class' => 'btn btn-primary btn-xs my-ajax',
                                    'style' => ' background-color: #20507B ',
                                    'title' => 'edit'
                        ]);
                    },
                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
