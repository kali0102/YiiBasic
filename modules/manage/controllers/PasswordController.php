<?php

namespace app\modules\manage\controllers;

use yii\web\Controller;
use app\models\PasswordForm;

class PasswordController extends Controller
{
    public function actionIndex()
    {
        $model = new PasswordForm;
        return $this->render('index', ['model' => $model]);
    }
}