<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;

class SigninController extends Controller
{

    public $attempts = 3;

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
        if (!Yii::$app->user->isGuest)
            return $this->redirect(['/user']);

        if ($this->_captchaRequired()) {
            $model = new LoginForm;
            $model->scenario = 'captchaRequired';
        } else
            $model = new LoginForm;

        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->login())
            return $this->redirect(['/user']);

        return $this->render('index', ['model' => $model]);
    }

    /**
     * 验证用户名及密码输入的错误次数
     * @return bool
     */
    private function _captchaRequired()
    {
        return Yii::$app->session->get('captchaRequired', 0) >= $this->attempts;
    }
}