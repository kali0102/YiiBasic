<?php

namespace app\controllers;

use yii\web\Controller;

class TestController extends Controller
{

    public $appSecret = '65cb98384a79480bb0d6a5d96530daaa';
    public $appId = 'f0dq7f17yb';
    public $userId = '8d3a09d3b2';
    public $channelId = '189060';

    public function actionIndex()
    {
        $userId = $this->userId;
        $appId = $this->appId;
        $appSecret = $this->appSecret;
        $channelId = $this->channelId;
        $timestamp = time() * 1000;
        $params['timestamp'] = $timestamp;
        $params['appId'] = $appId;
        echo '<pre>';


//        $sign = $this->getSign($params);
//        $url = "http://api.live.polyv.net/v1/users/" . $userId . "/channels?appId=" . $appId . "&timestamp=" . $timestamp . "&sign=" . $sign;
//        $result = $this->curl($url);
//        print_r($result);

        $params['userId'] = $userId;
        $sign = $this->getSign($params);
        $url = "http://api.live.polyv.net/v1/statistics/$channelId/realtime?appId=" . $appId . "&timestamp=" . $timestamp . "&userId=" . $userId . "&sign=" . $sign;
        $result = $this->curl($url);
        print_r($result);

    }

    public function curl($url)
    {
        //输出接口请求结果
        $ch = curl_init() or die (curl_error());
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 360);
        $response = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        //print_r($response);
        return $response;
    }


    /**
     * 签名算法
     * @param $params
     * @return string
     */
    public function getSign($params)
    {
        $appSecret = $this->appSecret;
        // 1. 对加密数组进行字典排序
        foreach ($params as $key => $value) {
            $arr[$key] = $key;
        }
        sort($arr);
        $str = $appSecret;
        foreach ($arr as $k => $v) {
            $str = $str . $arr[$k] . $params[$v];
        }
        $restr = $str . $appSecret;
        $sign = strtoupper(md5($restr));
        return $sign;

    }
}