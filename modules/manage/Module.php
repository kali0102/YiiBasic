<?php

namespace app\modules\manage;

/**
 * 管理模块
 * @author xxx <xxx@xx.com>
 * @link http://www.xxx.com
 * @copyright Copyright &copy; 2012-2014 xxx Inc
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\manage\controllers';

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;

        $currController = $action->controller->id;
        if (in_array($currController, ['signin', 'signout', 'error']))
            return true;

        \Yii::$app->admin->isGuest ? \Yii::$app->admin->loginRequired() : '';
        return true;
    }
}
