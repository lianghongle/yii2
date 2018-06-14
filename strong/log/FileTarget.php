<?php

namespace strong\log;

use yii\helpers\VarDumper;
use yii\log\Logger;

/**
 * api 请求相应文件格式日志
 *
 * 日志结尾不要'in /mnt/hgfs/vm_xmissy/_local/yii2/app_api/config/main.php:88'内容
 *
 * Class FileTarget
 * @package strong\log
 */
class FileTarget extends \yii\log\FileTarget
{
    public function formatMessage($message)
    {
        list($text, $level, $category, $timestamp) = $message;
        $level = Logger::getLevelName($level);
        if (!is_string($text)) {
            // exceptions may not be serializable if in the call stack somewhere is a Closure
            if ($text instanceof \Throwable || $text instanceof \Exception) {
                $text = (string) $text;
            } else {
                $text = VarDumper::export($text);
            }
        }

        $prefix = $this->getMessagePrefix($message);
        return date('Y-m-d H:i:s', $timestamp) . " {$prefix}[$level][$category] $text";
    }
}
