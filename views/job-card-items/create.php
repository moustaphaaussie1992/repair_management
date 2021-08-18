<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobCardItems */

$this->title = 'Create Job Card Items';
$this->params['breadcrumbs'][] = ['label' => 'Job Card Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-card-items-create">



    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
