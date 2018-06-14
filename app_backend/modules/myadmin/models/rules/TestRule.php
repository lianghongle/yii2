<?php
namespace backend\modules\myadmin\models\rules;

use Yii;

class TestRule extends \yii\rbac\Rule
{
    public $name = 'article';

    public function execute($user, $item, $params)
    {
        // 这里先设置为false,逻辑上后面再完善
        return false;
    }
}