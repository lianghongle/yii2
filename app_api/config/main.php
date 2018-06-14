<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',

    'basePath' => dirname(__DIR__),

    'controllerNamespace' => 'api\controllers',

    //默认路由
    'defaultRoute'        => 'site/index',

    'bootstrap' => [
        'log'
    ],

    'modules' => [
        'v1'   => [
            'class' => 'api\modules\v1\Module',
        ],
        'v2'   => [
            'class' => 'api\modules\v2\Module',
        ],
    ],

    'components' => [

        // todo 加密解密、数据校验、业务参数与通用参数
        'request' => [
            'csrfParam' => '_csrf-api',

            //api 关闭Csrf验证
            'enableCsrfValidation' => false,
        ],

        'response' => [
            'class'         => 'yii\web\Response',
            'on beforeSend' => function ($event) {

                /*var_dump(
                    Yii::$app->module->id,
                    Yii::$app->controller->id,
                    Yii::$app->controller->action->id
                );
                die;*/
                //调试模式，不用 json 返回。todo 感觉判断不对
                if(Yii::$app->controller->id !== 'default'){

                    $response = $event->sender;

                    if($response->getStatusCode() != 200){
                        if(!YII_DEBUG){
                            $response->data = [
                                'code'    => $response->getStatusCode(),
                                'data'    => '',
                                'message' => $response->statusText
                            ];
                            $response->format = yii\web\Response::FORMAT_JSON;
                        }
                    }else{
                        $response->data = [
                            'code'    => $response->getStatusCode(),
                            'data'    => $response->data,
                            'message' => $response->statusText
                        ];
                        $response->format = yii\web\Response::FORMAT_JSON;
                    }
                }
            },
            'on afterSend' => function ($event) {

                //{{ 请求、相应日志
    //          todo 请求需要记录的参数
//                $request = Yii::$app->request->getParams();
                $response = Yii::$app->response->data;

                $data = [
                    'request' => [],
//                    'response' => json_decode($response, true),
                    'response' => $response,
                ];

//                $log = PHP_EOL . json_encode($data);
                $log = $data;

                Yii::info($log,'user');
                //}}
            }
        ],

        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => [
//                'name' => '_identity-backend',
//                'httpOnly' => true
//            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'app-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [

                //请求相应日志
                [
                    'class'        => 'strong\log\FileTarget',  //Yii2处理日志的类
                    'levels'       => ['info'], //设置日志记录的级别
                    'categories'   => ['user'], //自定义日志分类
                    'maxFileSize'  => 1024 * 20,  //设置文件大小，以k为单位
                    //自定义文件路径 (一般项目的日志会打到服务器的其他路径，需要修改相应目录的权限哦~)
                    'logFile'      => '@runtime/logs/user_' . date('Ymd'),
//                    'logVars'      => ['_GET', '_POST'],  //捕获请求参数
                    'logVars'      => [],
                    'fileMode'     => 0775, //设置日志文件权限
                    'maxLogFiles'  => 100,  //同个文件名最大数量
                    'rotateByCopy' => false, //是否以复制的方式rotate
                    'prefix'       => function () {   //日志格式自定义 回调方法
                        if (Yii::$app === null) {
                            return '';
                        }
                        $request = Yii::$app->getRequest();
                        $ip = $request instanceof \yii\web\Request ? $request->getUserIP() : '-';
                        $module = Yii::$app->controller->module->id;
                        $controller = Yii::$app->controller->id;
                        $action = Yii::$app->controller->action->id;
                        return "[$ip][$module/$controller/$action]";
                    },
                ]
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'POST xxx'=>'v1/version',
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
//                '<controller:\w+>/<action:\w+>/<id:\d+>’=>’<controller>/<action>',
//                '<controller:\w+>/<action:\w+>’=>’<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
