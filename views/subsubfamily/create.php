<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subsubfamily */

$this->title = 'Create Subsubfamily';
$this->params['breadcrumbs'][] = ['label' => 'Subsubfamilies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subsubfamily-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
