<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

class ClearupController extends Controller
{
    public function actionCache()
    {
        \Yii::$app->cache->flush();
    }
}
