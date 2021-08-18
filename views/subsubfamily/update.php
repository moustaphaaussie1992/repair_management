<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subsubfamily */

$this->title = 'Update Subsubfamily: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subsubfamilies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subsubfamily-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
