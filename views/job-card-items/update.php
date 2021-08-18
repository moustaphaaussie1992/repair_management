<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobCardItems */

$this->title = 'Update Job Card Items: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Card Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-card-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
