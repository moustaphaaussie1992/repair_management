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
?>

<div style="margin-top: 100px;">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <?=
                Html::a('<i class="glyphicon glyphicon-folder-open"></i><span class="count-name">New Customer</span>',
                        ['/customer/create'],
                        [
                            'class' => 'card-counter success col-md-12',
                            'style' => ['border' => 'none']
                ])
                ?>
            </div>

            <div class="col-md-6">
                <?=
                Html::a('<i class="	glyphicon glyphicon-cog"></i><span class="count-name">New Job Record</span>',
                        ['/job-card/create'],
                        [
                            'class' => 'card-counter info col-md-12',
                            'style' => ['border' => 'none']
                ])
                ?>
            </div>



            <div class="col-md-6">
                <?=
                Html::a('<i class="	glyphicon glyphicon-send"></i><span class="count-name">Transfer To Service Center</span>',
                        ['/job-card/transfer'],
                        [
                            'class' => 'card-counter primary col-md-12',
                            'style' => ['border' => 'none']
                ])
                ?>
            </div>


            <div class="col-md-6">
                <?=
                Html::a('<i class="	glyphicon glyphicon-ok"></i><span class="count-name">Ready Items</span>',
                        ['/job-card/indexready'],
                        [
                            'class' => 'card-counter danger col-md-12',
                            'style' => ['border' => 'none']
                ])
                ?>
            </div>

        </div>
    </div>
</div>

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



</script>

<?php
JSRegister::end();
?>