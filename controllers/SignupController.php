<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;

class SignupController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 34,
                'minLength' => 3,
                'maxLength' => 4,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new SignupForm;
        $request = Yii::$app->request;
        if ($model->load($request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user))
                    return $this->redirect(['/user']);
            }
        }
        return $this->render('index', ['model' => $model]);
    }

}