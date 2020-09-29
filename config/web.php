<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$mail = require __DIR__ . '/mail.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'YHaioWQFOQVXllcupTufqktFYxDdGq5-',
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
                 'viewPath' => '@app/mail',
                 'useFileTransport' => false,
                 'transport' => [
                     'class' => 'Swift_SmtpTransport',
                     'host' => $mail['host'],
                     'username' => $mail['username'],
                     'password' => $mail['password'],
                     'port' => $mail['port'],
                     'encryption' => $mail['encryption'],
                 ],
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',     //ซ่อน site/index จาก homepage url
                '<action>'=>'site/<action>',  //ใช้ site เป็น controller หลัก --> สามารถเรียก method ใน controller ผ่าน url โดยไม่ต้องใส่ชื่อ class นำหน้า เช่น http://www.myweb.com/{root_folder_name}/site/register => http://www.myweb.com/{root_folder_name}/register
            ],
        ],
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
