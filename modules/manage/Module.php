<?php

namespace app\modules\manage;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\manage\controllers';

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
            if (Yii::$app->admin->isGuest)
                Yii::$app->admin->loginRequired();
            return true;
        } else
            return false;
    }
}
