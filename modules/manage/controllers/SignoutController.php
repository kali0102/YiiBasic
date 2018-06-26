<?php

namespace app\modules\manage\controllers;

use Yii;
use yii\web\Controller;

class SignoutController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->admin->logout();
        Yii::$app->admin->loginRequired();
    }
}