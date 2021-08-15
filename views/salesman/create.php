<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salesman */

$this->title = 'Create Salesman';
$this->params['breadcrumbs'][] = ['label' => 'Salesmen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
