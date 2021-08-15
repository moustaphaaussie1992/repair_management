<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\models\Users;
use app\widgets\Alert;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" >

    <?= $this->render('_head'); ?>

    <!--    <body style="
              background: rgb(119,119,119);
              background: linear-gradient(90deg, rgba(119,119,119,0.5634628851540616) 7%, rgba(119,119,119,0.47942927170868344) 53%, rgba(119,119,119,0.6502976190476191) 100%);
              " >-->
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">


            <?php
            NavBar::begin([
//                'brandLabel' => Html::img('@web/favicosn.png', [
//                    'class' => 'img-rounded',
//                    'style' => [
//                        'float' => 'left',
//                        'width' => '49px',
//                        'height' => '44px',
//                        'margin-right' => '5px',
//                        'margin-top' => '-10px',
//                    ]
//                ]) . Yii::t('app', 'Get4Less Repair Management System'),
                'brandLabel' => "Get4Less Repair Management System",
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
                    'style' => [
                        'width' => '100%',
                    ]
                ],
                'innerContainerOptions' => [
                    'class' => 'container',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' =>
//                ArrayHelper::merge(
                MenuHelper::getAssignedMenu(Yii::$app->user->id)
//                        , []
//                        [
//                    ['label' => "Special", 'url' => '#',
//                        'items' => [
//                            ['label' => 'Home', 'url' => ['/site/index']],
//                            ['label' => 'Users', 'url' => ['/users/index']],
//                            ['label' => Yii::t("app", "Change Password"), 'url' => ['users/change-password']],
//                        ]
//                    ],
//                        ]
//                        , [
//                    Yii::$app->user->isGuest ? (
//                            ['label' => 'Login', 'url' => ['/site/login']]
//                            ) : (
//                            '<li>'
//                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
//                            . Html::submitButton(
//                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
//                            )
//                            . Html::endForm()
//                            . '</li>'
//                            )
//                        ]
//                )
            ]);
//            echo "<form class='navbar-form navbar-right' role='search'>
//       <div class='form-group has-feedback'>
//            <input id='searchbox' type='text' placeholder='Search' class='form-control'>
//            <span id='searchicon' class='fa fa-search form-control-feedback'></span>
//        </div>
//  </form>";
            if (Users::isAdminRole()) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        ['label' => "Special", 'url' => '#',
                            'items' => [
                                ['label' => 'Home', 'url' => ['/site/index']],
                                ['label' => 'Users', 'url' => ['/users/index']],
                                ['label' => Yii::t("app", "Change Password"), 'url' => ['users/change-password']],
                            ]
                        ],
                    ]
                ]);
            } else {

            }

            echo Nav::widget([
                'options' => ['class' => 'navbar', 'style' => ['float' => 'right', 'text-color' => 'white']],
                'items' => [
                    Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ]
            ]);



            NavBar::end();
            ?>


            <main role="main" class="flex-shrink-0">
                <div class="container">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </main>




            <?php $this->endBody() ?>
    </body>


</html>
<?php $this->endPage() ?>
