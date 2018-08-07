<?php

$params = require __DIR__ . '/params.php';

$configs['id'] = 'YiiBasic';
$configs['language'] = 'zh-cn';
$configs['basePath'] = dirname(__DIR__);
$configs['bootstrap'] = ['log'];

// 别名
$configs['aliases']['@bower'] = '@vendor/bower-asset';
$configs['aliases']['@npm'] = '@vendor/npm-asset';

// 模块
$configs['modules'][$params['modules']['manage']] = ['class' => 'app\modules\manage\Module'];
$configs['modules'][$params['modules']['user']] = ['class' => 'app\modules\user\Module'];
$configs['modules'][$params['modules']['wap']] = ['class' => 'app\modules\wap\Module'];

// 资源
$configs['components']['assetManager']['bundles'] = require __DIR__ . '/assets.php';

// 请求
$configs['components']['request'] = ['cookieValidationKey' => '4Wj5W9yaTpkDsN99fOv0wPBRiXdunD7R'];

// 缓存
$configs['components']['cache'] = ['class' => 'yii\caching\FileCache'];

// 短信
$configs['components']['sms'] = ['class' => 'app\components\Sms'];

// 用户
$configs['components']['user'] = [
    'identityClass' => 'app\models\User',
    'enableAutoLogin' => true,
    'loginUrl' => ['/signin'],
    'identityCookie' => ['name' => '__user_identity'],
    'idParam' => '__user',
    'on afterLogin' => function ($event) {
        $user = $event->identity;
        $user->logins = $user->logins + 1;
        $user->last_login_at = $_SERVER['REQUEST_TIME'];
        $user->last_login_ip = ip2long(Yii::$app->request->userIP);
        $user->save();
    }
];
// 管理
$configs['components']['admin'] = [
    'class' => 'yii\web\User',
    'identityClass' => 'app\models\Admin',
    'enableAutoLogin' => true,
    'loginUrl' => ["/{$params['modules']['manage']}/signin"],
    'identityCookie' => ['name' => '__admin_identity'],
    'idParam' => '__admin',
    'on afterLogin' => function ($event) {
        $user = $event->identity;
        $user->logins = $user->logins + 1;
        $user->last_login_at = $_SERVER['REQUEST_TIME'];
        $user->last_login_ip = ip2long(Yii::$app->request->userIP);
        $user->save();
    }
];

// 错误
$configs['components']['errorHandler'] = ['errorAction' => 'site/error'];

// 邮件
$configs['components']['mailer'] = [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => true,
];

$configs['components']['log'] = [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
        ],
    ],
];

// 数据库
$configs['components']['db'] = require __DIR__ . '/db.php';

// URL重写
$configs['components']['urlManager'] = require __DIR__ . '/url.php';

// 参数
$configs['params'] = $params;

if (YII_ENV_DEV) {
    $configs['bootstrap'][] = 'debug';
    $configs['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $configs['bootstrap'][] = 'gii';
    $configs['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $configs;
