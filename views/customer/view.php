<?php

use app\models\Customer;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="customer-view">

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
        ],
    ])
    ?>

</div>
