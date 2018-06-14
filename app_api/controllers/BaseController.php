<?php
namespace api\controllers;

use yii\filters\Cors;
use yii\helpers\ArrayHelper;

/**
 * Class BaseController
 * @package api\controllers
 */
class BaseController extends \yii\web\Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],//定义允许来源的数组
                    'Access-Control-Request-Method' => ['GET','POST','PUT','DELETE', 'HEAD', 'OPTIONS'],//允许动作的数组
                ],
            ],
        ], parent::behaviors());
    }
}
