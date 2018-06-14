<?php
namespace backend\controllers;

use mdm\admin\components\Helper;
use yii\base\Exception;

/**
 * Class BaseController
 * @package backend\controllers
 */
class BaseController extends \strong\controllers\WebController
{
    public function beforeAction($action)
    {
        if(parent::beforeAction($action)){
            if(!Helper::checkRoute($this->route))
            {
//                throw new Exception('没有权限');
            }
        }

        return true;
    }
}
