<?php

namespace test\controllers;

use linslin\yii2\curl\Curl;
use yii\web\Controller;

class PackagistController extends Controller
{
    public function actionUpdate()
    {
        $curl = new Curl();
        $curl->setHeader('content-type', 'application/json');
        $curl->setGetParams([
            'username' => 'lianghongle',
            'apiToken' => 'MeC9Eu6ihNP_BkIoBR7p'
        ]);
        $curl->setRawPostData(json_encode([
            'repository' => [
                'url' => 'https://github.com/lianghongle/xmissy_math'
            ]
        ]));
        $result = $curl->post('https://packagist.org/api/update-package');
        var_dump($result);die;
    }
}

/*
curl -XPOST -H'content-type:application/json'
'https://packagist.org/api/update-package?username=lianghongle&apiToken=API_TOKEN'
-d'{"repository":{"url":"PACKAGIST_PACKAGE_URL"}}'
*/