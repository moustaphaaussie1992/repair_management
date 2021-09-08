<?php

use app\models\JobCardItems;
use app\models\Users;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model JobCardItems */

$this->title = 'Update Job Card Items: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Card Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-card-items-update">
    <?php $form = ActiveForm::begin(); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $user = Users::findOne(["id" => Yii::$app->user->id]);

    if (Users::isServiceRole()) {

        if ($model->email_sent) {

            echo $form->field($model, 'cost')->textInput(['class' => 'form-control class-content-title_series', 'disabled' => true]);
        } else {
            echo $form->field($model, 'cost')->textInput(['class' => 'form-control class-content-title_series', 'disabled' => false]);
        }
    }
    ?>
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
    <div class="form-group">
        <?php
        if (!$model->email_sent) {
//             Html::Button('Request Cost Confirmation', ['class' => 'btn btn-correct  ']);

            echo Html::a('<span class="btn btn-success  " style="background-color: #28a745">Send Email & Save</span>', null, [
                'class' => 'my-ajax send-email-button',
                'style' => ' background-color: #28a745  ',
                'title' => 'Send Confirmation Email',
                'itemId' => $model->id
            ]);
        }
        ?>
    </div>

</div>
<?php
JSRegister::begin([
    'id' => '1',
    'position' => static::POS_END
]);
?>

<script>



    $(".send-email-button").on('click', function () {

        var cost = $("#jobcarditems-cost").val();
        $("#jobcarditems-cost").
                alert(cost);
        var txt;
        var r = confirm("Are You Sure!");
        if (r == true) {
            var id = $(this).attr("itemId");
            var url = '<?= Url::toRoute("job-card/request-cost-confirmation") ?>';
//        alert(id);
//        return;
//        alert(request.getParameter("action"); );
//        var result = confirm("هل أنت متأكد؟");
//        if (result) {
//w hon bdde b3ataa lal api
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    "id": id, ///ah sa7 jarrabet ra2em 3ade raddet error
                    "cost": cost
                },
                success: function (data) {
                    console.log(data);
                    if (data["success"] == true) {
                        alert(data["message"]);
                    } else {
                        console.log(data["message"]);
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
//        }

//        $message = Yii::$app->twilio->sms('+96181756788', 'Hello World! sssss');

        } else {

        }

        alert("blabla");

    });


</script>

<?php
JSRegister::end();
?>
