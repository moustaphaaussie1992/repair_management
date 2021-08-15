<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<head>
    <meta charset = "<?= Yii::$app->charset ?>">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Url::home() ?>/favicon.png" type="image/x-icon" />
    <link rel="icon" href="<?= Url::home() ?>/favicon.png" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::home() ?>/favicon-32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::home() ?>/favicon-64.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::home() ?>/favicon-96.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::home() ?>/favicon-144.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Url::home() ?>/favicon-196.png">
</head>
