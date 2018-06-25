<?php

/**
 * 程序入口
 */

require __DIR__ . '/../config/constants.php';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$configs = require __DIR__ . '/../config/web.php';
$app = new yii\web\Application($configs);
$app->run();