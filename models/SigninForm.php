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
            // 不需要输入验证码
            [['username', 'password'], 'required', 'message' => '请输入{attribute}！'],
            // 需输入验证码
            [['username', 'password', 'captcha'], 'required', 'on' => ['captchaRequired'], 'message' => '请输入{attribute}！'],
            ['captcha', 'captcha', 'captchaAction' => 'manage/signin/captcha', 'on' => ['captchaRequired']],
            // 通用规则
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'captcha' => '验证码'
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
