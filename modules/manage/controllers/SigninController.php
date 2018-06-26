<?php

namespace app\modules\manage\controllers;

use Yii;
use yii\web\Controller;
use app\models\SigninForm;

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
        if (!Yii::$app->admin->isGuest)
            return $this->redirect(['/manage']);

        if ($this->_captchaRequired()) {
            $model = new SigninForm;
            $model->scenario = 'captchaRequired';
        } else
            $model = new SigninForm;

        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->login())
            return $this->redirect(['/manage']);

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