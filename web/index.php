<?php

/**
 * 程序入口
 */

$domain = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

require __DIR__ . '/../config/constants.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$configs = require __DIR__ . '/../config/web.php';
$app = new yii\web\Application($configs);
$app->run();


//$conn = new \AMQPConnection([
//    'host' => '127.0.0.1',
//    'port' => 5672,
//    'login' => 'admin',
//    'password' => 'admin'
//]);
//$conn->connect();

//phpinfo();

