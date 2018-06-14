<?php
namespace backend\controllers;

use common\models\user\UserSearch;
use Yii;
use yii\web\Controller;
use backend\models\user\UserSignupForm;

/**
 * 用户
 *
 * Class UserController
 * @package frontend\controllers
 */
class UserController extends BaseController
{
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserSignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
