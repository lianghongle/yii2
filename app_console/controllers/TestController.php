<?php
namespace console\controllers;

use common\models\blog\Post;
use Qcloud\Sms\SmsSingleSender;
use Yii;
use Overtrue\EasySms\EasySms;

class TestController extends BaseController
{
//    public function actionTest()
//    {
//        echo __FILE__ . PHP_EOL;
//    }

    /**
     * 内存泄漏？？？
     */
    public function actionTest() {
        $total = 10;
        var_dump('开始内存'.memory_get_usage());
        while($total){
            $ret=Post::findOne(['id'=>1]);
            var_dump('end内存'.memory_get_usage());
            unset($ret);
            $total--;
        }
    }

    public function actionSupervisor()
    {
        while (true){

        }
    }

    /**
     * 腾讯云 sms
     */
    public function actionSms()
    {
        $appid = 1400115381;
        $appkey = "753fe52110484b808c1594d779818992";
        $phoneNumber1 = "15989411244";
//        $phoneNumber1 = "15012452595";
        $templId = 159718;

        try {
            $sender = new SmsSingleSender($appid, $appkey);
            $params = [
                "指定模板单发",
                "深圳",
            ];
            // 假设模板内容为：测试短信，{1}，{2}，{3}，上学。
            $result = $sender->sendWithParam("86", $phoneNumber1, $templId, $params, "", "", "");
            $rsp = json_decode($result);
            echo $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }
    }

    /**
     * EasySms
     */
    public function actionEasysms()
    {
        $phone = '15989411244';
//        $phone = '15012452595';
//        $phone = '15279123301';

        try{
            $result = Yii::$app->sms->easySms->send($phone, [
                //                'content' => '',
//                "sign" => "腾讯云",
                'template' => '159718',
                'data' => [
                    'code' => 1,
                    'limit' => 2,
                ],
            ]);
        }catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $e){
            var_dump($e->getLastException()->raw['errmsg']);
        }


//        $config = [
//            // HTTP 请求的超时时间（秒）
//            'timeout' => 5.0,
//
//            // 默认发送配置
//            'default' => [
//                // 网关调用策略，默认：顺序调用
//                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
//
//                // 默认可用的发送网关
//                'gateways' => [
//                    'qcloud',
//                ],
//            ],
//            // 可用的网关配置
//            'gateways' => [
//                'errorlog' => [
//                    'file' => '/tmp/easy-sms.log',
//                ],
//                'qcloud' => [
//                    'sdk_app_id' => '1400115381', // SDK APP ID
//                    'app_key' => '753fe52110484b808c1594d779818992', // APP KEY
//                ],
//            ],
//        ];
//
//        $easySms = new EasySms($config);
//
//        try{
//            $easySms->send($phone, [
//                'content'  => '您的验证码为: 6379',
//                'template' => 159718,
//                'data' => [
//                    'code' => 6379,
//                    'limit' => 2,
//                ],
//            ]);
//        }catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $e){
//            var_dump($e->getLastException()->raw['errmsg']);
//        }
    }
}
