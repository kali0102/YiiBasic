<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * 管理登录
 */
class SigninForm extends Model
{
    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;

    private $_user = false;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],

            ['password', 'trim'],
            ['password', 'required'],

            ['captcha', 'required', 'on' => ['captchaRequired']],
            ['captcha', 'captcha', 'captchaAction' => Yii::$app->params['modules']['manage'] . '/signin/captcha', 'on' => ['captchaRequired']],

            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'captcha' => '验证码',
            'rememberMe' => '记住我'
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password))
                $this->addError($attribute, '用户名或密码错误！');
        }
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if (Yii::$app->admin->login($user, $this->rememberMe ? 3600 * 24 * 30 : 60))
                return true;
        } else {
            $counter = Yii::$app->session->get('captchaRequired', 0) + 1;
            Yii::$app->session->set('captchaRequired', $counter);
            return false;
        }
    }

    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = Admin::findByUsername($this->username);
        return $this->_user;
    }
}
