<?php
namespace test\controllers;

use Yii;
use yii\web\Controller;

/**
 * session
 *
 * Class SessionController
 * @package test\controllers
 */
class SessionController extends Controller
{
    public function actionIndex()
    {
//        var_dump(__FILE__);

//        Yii::$app->session->set('app-test_x', time());
//        Yii::$app->session->set('app-test_y', time());
//        var_dump(Yii::$app->session->set('app-test_x', ['a'=>1,'b'=>2]));
//        var_dump(Yii::$app->session->get('app-test_x'));
//        var_dump(Yii::$app->session->writeSession('app-test_x', 'x'));
//        var_dump(Yii::$app->session->writeSession('app-test_y', 'y'));
//        var_dump(Yii::$app->session->readSession('app-test_x'));
//        var_dump(Yii::$app->session->readSession('app-test_y'));

        $key_test = 'key-test';
        $get = Yii::$app->session->get($key_test);
        if(empty($get)){
            Yii::$app->session->set($key_test, time());
        }
        var_dump($get);


//        die();
    }
}
