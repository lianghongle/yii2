<?php
$params = array_merge(require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php');

return [
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [

        //如果将yii2-admin配置在common目录下是全局生效，会导致控制台(console)下命令报错。
        //因为仅将权限控制应用于frontend模块，所以将配置写到frontend目录下。
        'admin' => [
            'defaultRoute' => 'user',

            'class' => mdm\admin\Module::class,

            'layout'        => 'left-menu', // it can be '@path/to/your/layout'.
            /**/
            'controllerMap' => [
                'assignment' => [
                    'class'   => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\admin\User',
                    'idField' => 'id'
                ],
                'user' => [
                    'class'   => 'backend\controllers\AdminController',
//                    '_view' => 'backend\view\admin'
                ]
            ],
            'menus'         => [
//                'assignment' => [
//                    'label' => 'Grand Access' // change label
//                ],
//'route' => null, // disable menu route
            ]
        ],

        'myadmin' => [
            'class' => 'backend\modules\myadmin\Module',
        ],

        'xmissyadmin' => [
            'class' => xmissy\admin\Module::class,
            'defaultRoute' => 'default',
        ]
    ],
    'components'          => [
        'request'      => [
            'csrfParam' => '_csrf-backend',
        ],
        'user'         => [
            'identityClass'   => 'common\models\admin\User',
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name'     => '_identity-backend',
                'httpOnly' => true
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'app_backend',
            //            'class' => 'yii\redis\Session',
            'class' => \yii\redis\Session::class,
            'keyPrefix'=>'session.',
            'redis' => 'redis',
            'cookieParams' => [
                'domain' => '/',
                'httponly' => true,
            ],
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false,
            'rules'               => [

            ],
        ],

        //php yii migrate --migrationPath=@yii/rbac/migrations
        //php yii migrate --migrationPath=@mdm/admin/migrations
        'authManager'  => [
            'class'        => 'yii\rbac\DbManager',
            'defaultRoles' => [
                'guest',
//                '未登录用户',
            ],//添加此行代码，指定默认规则为 '未登录用户'
        ]
    ],

//    'as access' => [
//        'class' => 'strong\components\AccessControl',
//        'allowActions' => [
////            'site/error',
////            'site/*',//允许访问的节点，可自行添加
//            'admin/*',//允许所有人访问admin节点及其子节点
//            'debug/*',
//        ]
//    ],

    'params'              => $params,
];
