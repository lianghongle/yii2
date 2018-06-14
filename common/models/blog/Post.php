<?php

namespace common\models\blog;

use Yii;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property int $id
 * @property resource $title 标题
 * @property string $content 内容
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 * @property int $status 状态：
 * @property int $created_by 创建用户 id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'created_by'], 'integer'],
            [['title'], 'string', 'max' => 100],

//            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'content' => Yii::t('app', '内容'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '最后修改时间'),
            'status' => Yii::t('app', '状态'),
            'created_by' => Yii::t('app', '创建用户 id'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'created_at',
//                'updatedAtAttribute' => 'update_at',
                //'value' => new Expression('NOW()'),
                //'value'=>$this->timeTemp(),
            ],
        ];
    }

    //{{
    const STATUS_DRAFT = 1;
    const STATUS_PUBLISH = 2;
    const STATUS_DELETE = 3;
    public static $_status_labels = [
        self::STATUS_DRAFT => '草稿',
        self::STATUS_PUBLISH => '发布',
        self::STATUS_DELETE => '删除'
    ];
    //}}
}
