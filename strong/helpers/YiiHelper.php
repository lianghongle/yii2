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
     * @param $key                      key
     * @param string $default           默认值
     *
     * @return string
     */
    public static function getAppParams($key, $default = '')
    {
        if (isset(Yii::$app->params[$key])){
            return Yii::$app->params[$key] ? Yii::$app->params[$key] : $default;
        }else{
            return $default;
        }
    }
}
