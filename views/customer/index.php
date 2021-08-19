<?php

use app\models\CustomerSearch;
use yii\data\ActiveDataProvider;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel CustomerSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
            'email:email',
            'phone',
            [
                'class' => DataColumn::className(),
                'attribute' => 'salesman',
                'value' => function ($model) {
                    if ($rel = $model->salesman0) {
                        return Html::a($rel->name, ['salesman/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => DataColumn::className(),
                'attribute' => 'know_us_from',
                'value' => function ($model) {
                    if ($rel = $model->knowUsFrom) {
                        return Html::a($rel->name, ['social/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
