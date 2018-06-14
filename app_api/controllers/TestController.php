<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\SignupForm;

/**
 * test
 *
 * Class UserController
 * @package frontend\controllers
 */
class TestController extends BaseController
{
    public function actionList()
    {
        $type = Yii::$app->request->get('type', 'news');

        sleep(1);

        $data = [];

        switch ($type){
            case 'news':
                $data = $this->_news;
                break;
            case 'product':
                $data = $this->_products;
                break;
            default:
        }

        return $data;
    }

    public function actionDetail()
    {
        sleep(1);

        $data = [];

        $id = Yii::$app->request->get('id', 0);

        if(isset($this->_news[$id])){
            $data = $this->_news[$id];
        }

        return $data;
    }

    private $_news = [
        [
            'title' =>  "news_01",
            'desc' => "desc_01",
        ],
        [
            'title' =>  "news_02",
            'desc' => "desc_02",
        ],
        [
            'title' => "news_03",
            'desc' => "desc_03",
        ]
    ];

    private $_products = [
        [
            'name' =>  "product_01",
            'price' => 100.00,
            'desc' => 'desc',
        ],
        [
            'name' => "product_02",
            'price' => 99.99,
            'desc' => 'desc',
        ],
        [
            'name' => "product_03",
            'price' => 10.01,
            'desc' => 'desc',
        ]
    ];
}
