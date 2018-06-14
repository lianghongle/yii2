<?php
return [

    //设置目标语言 <html lang="zh-CN">
    'language' => 'zh-CN',//默认 en-US

    // 设置源语言为英语
    'sourceLanguage' => 'en-US',

    //时区
    'timeZone' => 'Asia/Shanghai',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
//        '@mdm/admin' => '$PATH\yii2-admin-1.0.3',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'session'=> [
            'class'=>'yii\web\CacheSession',
        ],



//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//
//            ],
//        ],

        //国际化
        'i18n' => [
            'translations' => [
                'app*' => [//模式 app* 表示所有以 app 开头的消息类别名称
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
//                    //'sourceLanguage' => 'en-US',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php',
//                    ],
                ],
            ],
        ],

        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
    ],
];
