<?php

namespace api\modules\v2\controllers;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends \api\controllers\BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo __FILE__;
//        return $this->render('index');
    }
}
