<?php
namespace console\controllers;

use common\models\blog\Post;

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
}
