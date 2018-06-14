<?php

namespace strong\components;


class AccessControl extends \mdm\admin\components\AccessControl
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
//        var_dump(\yii::$app->request->url);die;

//        if(\Yii::$app->user->can('/'. $action->controller->id . '/' . $action->id)){
//        if(\Yii::$app->user->can(\yii::$app->request->url)){
//            return true;
//        }else{
//            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
//        }

        $user = $this->getUser();
        if (\mdm\admin\components\Helper::checkRoute(\yii::$app->request->url, \Yii::$app->getRequest()->get(), $user)) {
            return true;
        }
        $this->denyAccess($user);
    }
}
