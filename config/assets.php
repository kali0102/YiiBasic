<?php

return [
    'yii\web\JqueryAsset' => [
        'sourcePath' => null,
        'js' => ['/static/js/jquery.min.js'],
        'jsOptions' => ['position' => \yii\web\View::POS_HEAD]
    ],

    'yii\bootstrap\BootstrapAsset' => [
        'sourcePath' => null,
        'css' => []
        //'css' => ['/static/css/bootstrap.min.css'],
    ],

    'yii\bootstrap\BootstrapPluginAsset' => [
        'sourcePath' => null,
        'js' => []
        //'js' => ['/static/js/bootstrap.min.js'],
    ],

    'yii\web\YiiAsset' => [
        'sourcePath' => null,
        'js' => ['/static/js/yii.js'],
    ],
        
    'yii\captcha\CaptchaAsset' => [
        'sourcePath' => null,
        'js' => ['/static/js/yii.captcha.js'],
    ],

    'yii\widgets\ActiveFormAsset' => [
        'sourcePath' => null,
        'js' => ['/static/js/yii.activeForm.js'],
    ],

    'yii\validators\ValidationAsset' => [
        'sourcePath' => null,
        'js' => ['/static/js/yii.validation.js'],
    ],
];