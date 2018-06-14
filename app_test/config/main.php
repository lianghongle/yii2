<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [

    'id' => 'app-test',

    'basePath' => dirname(__DIR__),

    'controllerNamespace' => 'test\controllers',

    //默认路由
    'defaultRoute'        => 'site/index',

    'bootstrap' => [
        'log'
    ],
    'modules' => [

    ],
    'components' => [
        'request' => [

            'csrfParam' => '_csrf-backend',
//            //api 关闭Csrf验证
//            'enableCsrfValidation' => false,
//
//            //根据请求头类型,接受参数做相应处理
//            'parsers'              => [
//                'application/json' => 'yii\web\JsonParser',
//                'text/json'        => 'yii\web\JsonParser',
//            ]
        ],

//        'response' => [
//            'class'         => 'yii\web\Response',
//            'on beforeSend' => function ($event) {
//                $response = $event->sender;
//                $response->data = [
//                    'code'    => $response->getStatusCode(),
//                    'data'    => $response->data,
//                    'message' => $response->statusText
//                ];
//                $response->format = yii\web\Response::FORMAT_JSON;
//            },
//        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true
            ],
        ],
        'session' => [//配置错误，会倒是 session 无效
            'name' => 'app-test',//cookies 里 session key,默认 PHPSESSID
            'class' => \yii\redis\Session::class,
            'keyPrefix'=>'session:test',//redis key
            'redis' => 'redis',//指向 redis
            'cookieParams' => [
                'path' => '/',
                'domain' => '',
                'httponly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
