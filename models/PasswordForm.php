<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PasswordForm extends Model
{
    public $current;
    public $new;
    public $confirm;

    private $_user = false;

    public function rules()
    {
        return [
            [['current', 'new', 'confirm'], 'required', 'message' => '请输入{attribute}！'],
            [['confirm'], 'compare', 'operator' => '==', 'compareAttribute' => 'new']
        ];
    }

    public function attributeLabels()
    {
        return ['current' => '当前密码', 'new' => '新设密码', 'confirm' => '确认密码'];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate())
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = User::findByUsername($this->username);
        return $this->_user;
    }
}
