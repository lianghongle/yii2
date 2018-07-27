<?php
/**
 * Created by PhpStorm.
 * User: lianghongle
 * Date: 2018/6/5
 * Time: 上午9:28
 */

namespace strong\helpers;

use Yii;

/**
 * 分页
 *
 * Class Page
 * @package strong
 */
class PageHelper
{
    public static $pageSize = 10;

    /**
     * 获取分页参数
     *
     * @param string $page          请求第几页
     * @param string $page_size     分页大小
     *
     * @return array
     */
    public static function getPageParams($pageParam = 'page', $pageSizeParam = 'page_size', $defaultPageSize = 10)
    {
        empty($defaultPageSize) && $defaultPageSize = self::$pageSize;

        $page = Yii::$app->request->get($pageParam);
        empty($page) && $page = 1;
        $pageSize = Yii::$app->request->get($pageSizeParam);
        empty($pageSize) && $pageSize = $defaultPageSize;

        self::$pageSize = $pageSize;

        return [$page, $pageSize];
    }

    /**
     * 获取返回需要的分页参数
     *
     * @param $count        数据总数
     * @param $pageSize     分页大小
     *
     * @return array
     */
    public static function getPageCount($count = 0, $pageSize = 10)
    {
        $pageSize = $pageSize ? $pageSize : self::$pageSize;

        return ceil($count / $pageSize);
    }
}