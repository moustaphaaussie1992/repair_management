<?php

use app\models\ItemSearch;
use yii\data\ActiveDataProvider;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel ItemSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
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
            'code',
            [
                'class' => DataColumn::className(),
                'label' => 'Family',
                'attribute' => 'family',
                'value' => function ($model) {
                    if ($rel = $model->family0) {
                        return Html::a($rel->name, ['family/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => DataColumn::className(),
                'label' => 'Subfamily',
                'attribute' => 'subfamily',
                'value' => function ($model) {
                    if ($rel = $model->subfamily0) {
                        return Html::a($rel->name, ['subfamily/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => DataColumn::className(),
                'label' => 'Subsubfamily',
                'attribute' => 'subsubfamily',
                'value' => function ($model) {
                    if ($rel = $model->subsubfamily0) {
                        return Html::a($rel->name, ['subsubfamily/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => DataColumn::className(),
                'label' => 'Brand',
                'attribute' => 'brand_id',
                'value' => function ($model) {
                    if ($rel = $model->brand) {
                        return Html::a($rel->name, ['brand/view', 'id' => $rel->id,], ['data-pjax' => 0]);
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
