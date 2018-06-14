<?php
namespace backend\controllers;

use common\models\admin\UserSearch;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use backend\models\admin\UserSignupForm;

/**
 * 管理员
 *
 * Class UserController
 * @package frontend\controllers
 */
class AdminController extends BaseController
{
    public function __construct($id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->setViewPath('@backend/views/admin');
    }

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
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
