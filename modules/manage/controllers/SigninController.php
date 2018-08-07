<?php

namespace app\modules\manage\controllers;

use Yii;
use yii\web\Controller;
use app\models\SigninForm;

/**
 * 登录
 */
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
        $params = Yii::$app->params;
        if (!Yii::$app->admin->isGuest)
            return $this->redirect(["/{$params['modules']['manage']}"]);

        if ($this->_captchaRequired()) {
            $model = new SigninForm;
            $model->scenario = 'captchaRequired';
        } else
            $model = new SigninForm;
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->redirect(["/{$params['modules']['manage']}"]);

        return $this->render('index', ['model' => $model]);
    }

    /**
     * 验证用户名及密码输入的错误次数
     * @return bool
     */
    private function _captchaRequired()
    {
        $session = Yii::$app->session;
        return $session->get('captchaRequired', 0) >= $this->attempts;
    }
}