<?php
/* @var $this View */
/* @var $content string */

use app\assets\MetronicAsset;
use app\assets\MetronicRtlAsset;
use app\components\LanguageSwitcher;
use app\models\Users;
use app\widgets\Alert;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

//AppAsset::register($this);
if (LanguageSwitcher::isRtl()) {
    MetronicRtlAsset::register($this);
} else {
    MetronicAsset::register($this);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" >

    <?= $this->render('_head'); ?>


    <body   style='background-image: url("<?= Url::base() . '/bg13.jpg' ?>"); background-size: cover;'>
        <?php $this->beginBody() ?>
        <div class="wrap">


            <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/favicon.png', [
                    'class' => 'img-rounded',
                    'style' => [
                        'float' => 'left',
                        'width' => '49px',
                        'height' => '44px',
                        'margin-right' => '5px',
                        'margin-top' => '-10px',
                    ]
                ]) . Yii::t('app', 'Get4Less Repair Management System'),
                'brandLabel' => "Get4Less Repair Management System",
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-inverse navbar-expand-md navbar-dark bg-dark fixed-top',
                    'style' => [
                        'width' => '100%',
                    ]
                ],
                'innerContainerOptions' => [
                    'class' => 'container',
                ],
            ]);


            echo Nav::widget([
                'options' => [
                    'class' => 'navbar-nav navbar-right',
                    'id' => 'my-navbar-nav',
                ],
                'items' => ArrayHelper::merge(MenuHelper::getAssignedMenu(Yii::$app->user->id), [
                        ], Yii::$app->user->id == 1 ?
                                [(
                            ['label' => Yii::t("app", "Special"), 'url' => '#',
                                'items' => [
                                    ['label' => Yii::t("app", "Change Password"), 'url' => ['users/change-password']],
                                    ['label' => Yii::t("app", "Users"), 'url' => ['/users/index']],
//                                    ['label' => Yii::t("app", "Employees"), 'url' => ['/user-employee/index']],
//                                    ['label' => Yii::t("app", "المندوبين"), 'url' => ['/delegate/index']],
//                                    ['label' => Yii::t("app", "Rbac"), 'url' => ['/admin']],
//                                        ['label' => Yii::t("app", "Translate"), 'url' => ['/translatemanager/language/list']],
                                ]
                            ] )] : [( Users::isAdminRole() == true ?
                                    ['label' => Yii::t("app", "Special"), 'url' => '#',
                                'items' => [
                                    ['label' => Yii::t("app", "Change Password"), 'url' => ['users/change-password']],
                                    ['label' => Yii::t("app", "Users"), 'url' => ['/users/index']],
//                                    ['label' => Yii::t("app", "Employees"), 'url' => ['/user-employee/index']],
                                ]
                                    ] : ['label' => Yii::t("app", "Chanjdge Password"), 'url' => ['users/change-password']] )],
                        [
                            Yii::$app->user->isGuest ? (
                                    ['label' => Yii::t("app", "Login"), 'url' => ['/site/login']]
                                    ) : (
                                    '<li>'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                            Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout', 'style' => 'padding-top: 15px;padding-bottom: 15px;line-height: 20px;color: #9d9d9d !important']
                                    )
                                    . Html::endForm()
                                    . '</li>'
                                    )
                        ]
//                        , [languageSwitcher::Widget()]
                )
            ]);
            NavBar::end();
            ?>
            <div class="container" style="width: 80%;">



                <?php
//                echo SideNav::widget([
//                    'type' => SideNav::TYPE_DEFAULT,
//                    'heading' => '',
//                    'items' =>
//                    MenuHelper::getAssignedMenu(Yii::$app->user->id)
////                    [
////                            [
////                            'url' => '#',
////                            'label' => 'Home',
////                            'icon' => 'home'
////                        ],
////                            [
////                            'label' => 'Help',
////                            'icon' => 'question-sign',
////                            'items' => [
////                                    ['label' => 'About', 'icon' => 'info-sign', 'url' => '#'],
////                                    ['label' => 'Contact', 'icon' => 'phone', 'url' => '#'],
////                            ],
////                        ],
////                    ],
//                ]);
//                echo Breadcrumbs::widget([
//                    'homeLink' => [
//                        'label' => Yii::t('yii', 'Dashboard'),
//                        'url' => Yii::$app->homeUrl,
//                    ],
//                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <!--        <footer class="footer yii-debug-toolbar  " style=" position:fixed;bottom:4px ;text-align:left;width:96px;transition:width .3s ease;" >
                    <div class="container">
                        <p class="pull-left"><?php // Yii::t('app', 'Temp App') . ' &copy; ' . date('Y')                       ?></p>
                    </div>
                </footer>-->



        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
