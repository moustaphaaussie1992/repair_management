<?php

use app\models\JobCard;
use kartik\checkbox\CheckboxX;
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
