<?php

namespace xmissy\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * 操作
 *
 * Class Operation
 * @package xmissy\admin\models
 */
class Operation extends \strong\admin\strong\Model
{
    /**
     * 模型对应存储名称
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%operation}}';
    }

    /**
     * 模型验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * attribute labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'desc' => Yii::t('app', '描述'),
            'route' => Yii::t('app', '路由'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '最后更新时间'),
        ];
    }

    public function attributes()
    {
        return [];
    }
}
