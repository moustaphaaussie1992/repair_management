<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subfamily */

$this->title = 'Create Subfamily';
$this->params['breadcrumbs'][] = ['label' => 'Subfamilies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subfamily-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
