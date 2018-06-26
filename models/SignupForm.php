<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $confirmPassword;
    public $email;
    public $captcha;


    public function rules()
    {
        return [
            [['email', 'username', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'password', 'confirmPassword', 'email', 'captcha'], 'required', 'message' => '请输入{attribute}！'],
            [['confirmPassword'], 'compare', 'operator' => '==', 'compareAttribute' => 'password', 'message' => '两次密码不一致！'],
            [['email'], 'email', 'message' => '邮箱格式错误！'],
            ['captcha', 'captcha', 'captchaAction' => '/signup/captcha'],
            [['username', 'email'], 'unique', 'targetClass' => 'app\models\User', 'message' => '{attribute}已被占用！']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'confirmPassword' => '确认密码',
            'captcha' => '验证码'
        ];
    }

    public function signup()
    {
        if (!$this->validate())
            return null;

        $user = new User;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);

        if ($user->save())
            return $user;
        else {
            echo '<pre>';
            print_r($user);
            die;
        }
    }
}