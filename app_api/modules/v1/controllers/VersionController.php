<?php
namespace api\modules\v1\controllers;

/**
 * api 用 module 控制版本
 *
 * 最初 api 版本
 *
 * Class VersionController
 * @package api\modules\v1\controllers
 */
class VersionController extends \api\controllers\BaseController
{
    /**
     * @return array
     */
    public function actionIndex()
    {
//        \yii\helpers\VarDumper::dump(\yii::$app);die;
        return [
            'code' => 0,
            'msg' => 0,
            'data' => [
                'version' => $this->module->id,
                'file' => __FILE__
            ],
        ];
    }
}
