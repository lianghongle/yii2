<?php
namespace api\controllers;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public function actionIndex()
    {
        return [
            'code' => 0,
            'msg' => 0,
            'data' => 'home',
        ];
    }

    public function actionException()
    {
        throw new \Exception(__FILE__);
    }
}
