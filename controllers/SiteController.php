<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {




        die;

        $conn_args = array(
            'host'=>'127.0.0.1',  //rabbitmq 服务器host
            'port'=>5672,         //rabbitmq 服务器端口
            'login'=>'guest',     //登录用户
            'password'=>'guest',   //登录密码
            'vhost'=>'/'         //虚拟主机
        );
        $e_name = 'e_demo';
        $q_name = 'q_demo';
        $k_route = 'key_1';

        $conn = new \AMQPConnection($conn_args);
        if(!$conn->connect()){
            die('Cannot connect to the broker');
        }

        die;
        $connection = new \AMQPConnection(['127.0.0.1', '5672', 'guest', 'guest', '/']);
        $connection->connect() or die("Cannot connect to the broker!\n");


        die;
        phpinfo();
        die;
        echo mb_substr('33333333333333333', 0, 4, 'UTF-8');


        die;
        echo strlen('即使美联储放鸽也难扭即使美联储放鸽也难扭即使美联储放鸽也难扭即使美联储');

//        echo strlen('黄金投资的种类分为现货黄金，期货黄金，纸黄金，黄金衍生品。国际市场以英国和美国为主。英国主要是现货黄金市场，就是通常人们所说的伦敦金');
        die;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $haseId = isset($_GET['hashId']) ? $_GET['hashId'] : '';
        $num = isset($_GET['num']) ? $_GET['num'] : '';

        echo $id . $haseId . $num;

//        $startTime = '';
//        echo date('Y-m-d', strtotime('+1 week last friday')) . ' 23:59:59';
//
//
//        die;
//
//        echo md5(123456) . "<br/>";
//        echo 'e10adc3949ba59abbe56e057f20f883e';
//
//        echo "<br/>";
//        echo md5('e10adc3949ba59abbe56e057f20f883e');
//
//        die;
//        echo Yii::$app->cache->get('name');
        echo "<br/>";
        echo Yii::$app->urlManager->createUrl(['/site/index', 'id' => 11, 'hashId' => 'abcd123efgh', 'num' => 22]);
        return $this->render('index');
    }


}
