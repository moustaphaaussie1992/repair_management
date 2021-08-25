<?php

use kartik\datecontrol\DateControl;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'repair-management ',
    'name' => 'Get4Less Repair Management System',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Ne6NFOtgqgR2leVZLoBWIFhQ4zpY2a7V',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
// 'useFileTransport' to false and configure a transport
// for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
//        'urlManager' => [
//            'class' => 'yii\web\UrlManager',
//            // Disable index.php
//            'showScriptName' => false,
//            // Disable r= routes
//            'enablePrettyUrl' => true,
//            'rules' => [
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
////                '<controller:\w+>/<action:\w+>/<id:\d+>/<id1:\d+>/' => '<controller>/<action>',
//            ],
//        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => $db,
        /*
          'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
          ],
          ],
         */
//        'sms' => [
//            'class' => 'wadeshuler\sms\twilio\Sms',
//            // Advanced app use '@common/sms', basic use '@app/sms'
////            'viewPath' => '@common/sms', // Optional: defaults to '@app/sms'
//// send all sms to a file by default. You have to set
//// 'useFileTransport' to false and configure the messageConfig['from'],
//// 'sid', and 'token' to send real messages
//            'useFileTransport' => true,
//            'messageConfig' => [
//                'from' => '+16503185356', // Your Twilio number (full or shortcode)
//            ],
//            // Find your Account Sid and Auth Token at https://twilio.com/console
//            'sid' => 'AC4821e6dd86449442269a9552b93387d0',
//            'token' => '6c5a0d2f74306fe55a4bb553d96b7df4',
//        // Tell Twilio where to POST information about your message.
//// @see https://www.twilio.com/docs/sms/send-messages#monitor-the-status-of-your-message
////'statusCallback' => 'https://example.com/path/to/callback',      // optional
//        ],
        'twilio' => [
            'class' => '\dosamigos\twilio\TwilioComponent',
            'sid' => 'AC4821e6dd86449442269a9552b93387d0',
            'token' => '6c5a0d2f74306fe55a4bb553d96b7df4',
            'phoneNumber' => '+16503185356'
        ]
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            'displaySettings' => [
                DateControl::FORMAT_DATE => 'l dd-MM-yyyy',
                DateControl::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                DateControl::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                DateControl::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
        ],
    ],
//    'language' => 'en-US',
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*'
//            'api/*',
//            'site/login',
//            'site/login-client',
//            'site/sign-up-client',
//            'site/forget-password',
//            'site/new-password',
//            'site/error',
//            'debug/*',
//            'admin/*',
//            'mobile/*',
        ]
    ],
    'timeZone' => 'Asia/Beirut',
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
