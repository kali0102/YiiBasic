<?php

namespace app\components;

use yii\base\Component;

class Sms extends Component
{
    public static $url = 'http://106.ihuyi.cn/webservice/sms.php?method=Submit';
    public static $params = array(
        'account' => 'cf_yif',
        'password' => 'MFAMfR',
        'mobile' => '',
        'content' => '',
    );

    public static function send($mobile, $content)
    {
        self::$params['mobile'] = $mobile;
        self::$params['content'] = $content;
        $postData = http_build_query(self::$params);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::$url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        $callback = curl_exec($curl);
        curl_close($curl);

        $response = json_decode(json_encode(simplexml_load_string($callback, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $response;
    }
}