<?php

use app\models\Branch;
use app\models\Users;
use kartik\widgets\Select2;
use richardfan\widget\JSRegister;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\User;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Users */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'role')->dropDownList(Users::getRoles()) ?>
    <?=
    $form->field($model, 'branch')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Branch::find()->all(), 'id', function($model) {
                    return $model['name'];
                }),
        'options' => [
//            'id' => 'test',
            'placeholder' => Yii::t("app", "Select "),
//            'dir' => 'rtl',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Branch");
    ?>


    <?= $form->field($model, 'c_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_phone')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
JSRegister::begin([
    'id' => '1',
    'position' => static::POS_END
]);
?>

<script>
    var role = $("#users-role").val();

    $(".field-users-branch").hide();

    if (role == '<?= app\models\Users::ROLE_BRANCH ?>') {

        $(".field-users-branch").show();

    } else {

        $(".field-users-branch").hide();
    }

    $("#users-role").on("change", function () {
        var role = $("#users-role").val();

        if (role == '<?= app\models\Users::ROLE_BRANCH ?>') {
            $(".field-users-branch").show();
        } else {

            $(".field-users-branch").hide();
        }
    });

</script>
<?php
JSRegister::end();
?>

