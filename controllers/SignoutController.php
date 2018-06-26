<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SignoutController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->user->logout();
        Yii::$app->user->loginRequired();
    }
}