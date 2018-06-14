<?php

namespace common\models\stock;

use Yii;

class Stock extends \strong\models\base\Mysql
{
    public static function getDb()
    {
//        return parent::getDb();
        return \Yii::$app->db_stock;  // 修改使用名为 "db2" 的应用组件
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code'             => Yii::t('app', '代码'),
            'name'             => Yii::t('app', '名称'),
            'industry'         => Yii::t('app', '所属行业'),
            'area'             => Yii::t('app', '地区'),
            'pe'               => Yii::t('app', '市盈率'),
            'outstanding'      => Yii::t('app', '流通股本(亿)'),
            'totals'           => Yii::t('app', '总股本(亿)'),
            'totalAssets'      => Yii::t('app', '总资产(万)'),
            'liquidAssets'     => Yii::t('app', '流动资产'),
            'fixedAssets'      => Yii::t('app', '固定资产'),
            'reserved'         => Yii::t('app', '公积金'),
            'reservedPerShare' => Yii::t('app', '每股公积金'),
            'esp'              => Yii::t('app', '每股收益'),
            'bvps'             => Yii::t('app', '每股净资'),
            'pb'               => Yii::t('app', '市净率'),
            'timeToMarket'     => Yii::t('app', '上市日期'),
            'undp'             => Yii::t('app', '未分利润'),
            'perundp'          => Yii::t('app', '每股未分配'),
            'rev'              => Yii::t('app', '收入同比(%)'),
            'profit'           => Yii::t('app', '利润同比(%)'),
            'gpr'              => Yii::t('app', '毛利率(%)'),
            'npr'              => Yii::t('app', '净利润率(%)'),
            'holders'          => Yii::t('app', '股东人数'),
        ];
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new CommentQuery(get_called_class());
//    }
}
