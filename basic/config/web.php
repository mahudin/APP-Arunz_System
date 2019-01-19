<?php
use kartik\mpdf\Pdf;
$params = require(__DIR__ . '/params.php');

$config = [
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'downloadAction' => 'gridview/export/download',
            'i18n' => []
        ],
        'dynagrid'=>[
            'class'=>'\kartik\dynagrid\Module',
    // other settings (refer documentation)
        ],
        'datecontrol'=>[
            'class'=>'kartik\datecontrol\Module',
            ]
        ],


    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kG-YDRBM4OR6ELrB5Z41g82wyfgL_4uA',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

            //'viewPath' => '@common/mail',
           /* 'transport' => [
                'class' => 'Swift_MailTransport',
            ],*/
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'arunz.eu',
                'username' => 'info@arunz.eu',
                'password' => 'Iamnotcheater123',
                'port' => '587',
                'encryption' => 'tls',
            ],

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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
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
