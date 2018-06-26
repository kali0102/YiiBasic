<?php

namespace app\modules\user;



class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\user\controllers';

    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $rote = $action->controller->id . '/' . $action->id;
            $allowPages = ['signin/index', 'signin/captcha', 'error/index'];
            if (in_array($rote, $allowPages))
                return true;
            if (\Yii::$app->user->isGuest)
                \Yii::$app->user->loginRequired();
            return true;
        } else
            return false;
    }
}
