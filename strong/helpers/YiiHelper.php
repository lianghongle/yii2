<?php

namespace strong\helpers;

use Yii;

/**
 * Class YiiHelper
 * @package strong\helpers
 */
class YiiHelper
{
    /**
     * 对 Yii::$app->params['key'] 的封装
     *
     * @param $key
     * @param bool $default
     *
     * @return bool
     */
    public static function getAppParams($key, $default = '')
    {
        if (isset(Yii::$app->params[$key])){
            return Yii::$app->params[$key];
        }else{
            return $default;
        }
    }
}
