<?php

namespace app\modules\manage\controllers;

use yii\web\Controller;

class ClearupController extends Controller
{
    public function actionCache()
    {
        \Yii::$app->cache->flush();
        \Yii::$app->db->schema->refresh();
        echo 'ok';
    }
}