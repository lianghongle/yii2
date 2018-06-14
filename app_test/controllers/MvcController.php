<?php
namespace test\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class MvcController extends Controller
{
    public function actionIndex()
    {
//        不使用布局
//        $this->layout = false;

        return $this->render('index');
    }

    public function actionMca()
    {
        $module = Yii::$app->module->id;
        $module = $this->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        var_dump($module, $action, $controller);
    }
}
