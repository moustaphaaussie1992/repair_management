<?php
/* @var $this yii\web\View */
?>
<?php

use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */


$this->title = 'Get4Less Repair Management System';


//$email = new \SendGrid\Mail\Mail();
//$email->setFrom("test@example.com", "Example User");
//$email->setSubject("Sending with SendGrid is Fun");
//$email->addTo("test@example.com", "Example User");
//$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
//$email->addContent(
//        "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
//);
//$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
//try {
//    $response = $sendgrid->send($email);
//    print $response->statusCode() . "\n";
//    print_r($response->headers());
//    print $response->body() . "\n";
//} catch (Exception $e) {
//    echo 'Caught exception: ' . $e->getMessage() . "\n";
//}
//
//// It returns a \Twilio\Rest\Api\V2010\Account\MessageInstance
//echo $message->sid;
//$result = Yii::$app->sms->compose()
//        ->setTo('+96181756788')
//        ->setMessage("Hey asdasdasd this is a test!")
//        ->send();
//
//if ($result === true) {
//    VarDumper::dump('SMS was sent!', 3, true);
//    die();
////    echo 'SMS was sent!';
//} else {
//    VarDumper::dump('Error sending SMS!!', 3, true);
//    die();
//
////    'Error sending SMS!';
//}
?>

<div style="margin-top: 100px;">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <?=
                Html::a('<i class="glyphicon   glyphicon glyphicon-plus"></i><span class="count-name">New Customer</span>', ['/customer/create'], [
                    'class' => 'card-counter success col-md-12',
                    'style' => ['border' => 'none']
                ])
                ?>
            </div>

            <div class="col-md-6">
                <?=
                Html::a('<i class="glyphicon glyphicon-folder-open"></i><span class="count-name">New Job Record</span>', ['/job-card/create'], [
                    'class' => 'card-counter info col-md-12',
                    'style' => ['border' => 'none']
                ])
                ?>
            </div>



            <div class="col-md-6">
                <?=
                Html::a('<i class="	glyphicon glyphicon-th-list"></i><span class="count-name">Job Cards</span>', ['/job-card-items/index'], [
                    'class' => 'card-counter primary col-md-12',
                    'style' => ['border' => 'none']
                ])
                ?>
            </div>





        </div>
    </div>
</div>
<!--<button id="sendMessage">Send message</button>-->

<style>

    .card-counter{
        box-shadow: 10px 10px 5px #aaaaaa;

        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 200px;
        border-radius: 5px;
        transition: .3s linear all;
        text-align: right;
    }

    .card-counter:hover{
        box-shadow: 4px 4px 20px #DADADA;
        transition: .05s linear all;
    }

    .card-counter.primary{
        background-color: #632724;

        color: #FFF;
    }

    .card-counter.danger{
        background-color: #923734;
        color: #FFF;
    }

    .card-counter.success{
        background-color: #a93f3b;
        color: #FFF;
    }

    .card-counter.info{
        background-color: #ba5754;
        color: #FFF;
    }

    .card-counter i{
        font-size: 7em;
        opacity: 1;
        margin-top: 50px;
        margin-right: 20px;
    }

    .card-counter .count-numbers{
        position: absolute;
        left: 35px;
        top: 20px;
        font-size: 32px;
        display: block;
    }

    .card-counter .count-name{
        position: absolute;
        left: 35px;
        top: 40px;
        text-transform: capitalize;
        opacity: 1;
        display: block;
        font-size: 35px;
    }

</style>

<?php
JSRegister::begin([
    'id' => '1',
    'position' => static::POS_END
]);
?>

<script>

//    $("#sendMessage").on('click', function () {
//
//        var message = "hello musta";
//        var result = confirm("هل أنت متأكد؟");
//        if (result) {
//            $.ajax({
//                url: '<?php // echo Url::toRoute("/site/send-message")      ?>',
//                type: "POST",
//                data: {
//                    'message': message,
//                },
//                success: function (data) {
//
//                    if (data["success"] == true) {
//                        console.log(data);
////                        alert("meshe l7al");
//                    } else {
//                        console.log("error");
////                        alert('error');
//                    }
//                },
//                error: function (errormessage) {
//                    console.log("not working");
//                }
//            });
//        }
//
////        $message = Yii::$app->twilio->sms('+96181756788', 'Hello World! sssss');
//
//    });

</script>

<?php
JSRegister::end();
?>
