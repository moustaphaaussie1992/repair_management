<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\JobCardItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Card Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-card-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Job Card Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'job_card_id',
            'item_id',
            'cost',
            'warranty',
            //'warranty_type',
            //'status',
            //'current_location',
            //'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
