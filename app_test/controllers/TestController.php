<?php
namespace test\controllers;

use common\models\blog\Post;
use common\services\stock\StockService;
use Yii;
use yii\web\Controller;

/**
 * db(mysql) test
 *
 * Site controller
 */
class TestController extends Controller
{
//    public $layout = false;

    public function actionIndex()
    {
        echo time();
        echo '<hr>';


        var_dump(StockService::detail());
    }
}
