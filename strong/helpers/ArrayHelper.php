<?php

namespace strong\helpers;

/**
 * Class ArrayHelper
 * @package strong\helpers
 */
class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * 生成树
     *
     * @param $arr                      数据
     * @param $pid                      开始计数的父级 ID
     * @param $result                   生成结果
     * @param string $idName            ID name
     * @param string $pidName           PID name
     * @param string $childrenName      children name
     */
    public static function getTree(&$arr, $pid, &$result, $idName = 'id', $pidName = 'pid', $childrenName = 'children')
    {
        foreach ($arr as $key => $val) {
            if ($val[$pidName] == $pid) {
                $val[$childrenName] = [];
                self::getTree($arr, $val[$idName], $val[$childrenName]);
                $result[] = $val;
                unset($arr[$key]);
            }
        }
    }

    /**
     * 递归 array_map
     *
     * @param $arr
     * @param callable $callback
     *
     * @return array
     */
    public static function array_map_recursive($arr, callable $callback)
    {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                $arr[$key] = self::array_map_recursive($value, $callback);
            }
        } else {
            $arr = $callback($arr);
        }
        return $arr;
    }
}
