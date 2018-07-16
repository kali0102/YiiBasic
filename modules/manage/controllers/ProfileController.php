<?php

namespace app\modules\manage\controllers;

use app\helpers\CController;

class ProfileController extends CController
{
    public function actionIndex()
    {


        return $this->render('index');
    }
}