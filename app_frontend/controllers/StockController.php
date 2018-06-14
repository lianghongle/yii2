<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * 用户
 *
 * Class UserController
 * @package frontend\controllers
 */
class StockController extends Controller
{
    public $layout = 'empty';

    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }
}
