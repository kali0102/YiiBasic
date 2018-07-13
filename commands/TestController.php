<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class TestController extends Controller
{
    /**
     * @return int Exit code
     */
    public function actionIndex()
    {
        sleep(1);
        echo "I am is test/index\n";
        return ExitCode::OK;
    }

    /**
     * @return int Exit code
     */
    public function actionTest()
    {
        sleep(2);
        echo "I am is test/test\n";
        return ExitCode::OK;
    }

}