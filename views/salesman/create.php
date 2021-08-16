<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salesman */

$this->title = 'Create Salesman';
$this->params['breadcrumbs'][] = ['label' => 'Salesmen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesman-create">


    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <?= Html::encode($model->id) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=
            Html::a(
                    Yii::t('cruds', 'Cancel'),
                    \yii\helpers\Url::previous(),
                    ['class' => 'btn btn-default'])
            ?>
        </div>
    </div>

    <hr />

    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>