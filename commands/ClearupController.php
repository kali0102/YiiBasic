<?php

namespace app\commands;

use yii\console\ExitCode;
use yii\console\Controller;

/**
 * 清除脚本
 */
class ClearupController extends Controller
{
    /**
     * 清除数据缓存
     */
    public function actionCache()
    {
        \Yii::$app->cache->flush();
        echo ExitCode::OK;
    }

    /**
     * 清除表结构缓存
     * @param null $tableName
     */
    public function actionTableSchema($tableName = null)
    {
        if (null == $tableName)
            \Yii::$app->db->schema->refresh();
        else
            \Yii::$app->db->schema->refreshTableSchema($tableName);
        echo ExitCode::OK;
    }
}
