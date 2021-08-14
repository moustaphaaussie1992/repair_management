<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobCard */

$this->title = 'Create Job Card';
$this->params['breadcrumbs'][] = ['label' => 'Job Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
