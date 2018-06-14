<?php
namespace strong\log;

use yii\log\Logger;

/**
 * 不记录日志
 *
 * \Yii::setLogger(new \strong\log\EmptyLogger());
 *
 * Class EmptyLogger
 * @package strong\log
 */
class EmptyLogger extends Logger
{
    public function log($message, $level, $category = 'application')
    {
        return false;
    }
}