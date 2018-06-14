<?php

namespace common\models\blog;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $ id
 * @property string $content 内容 
 * @property int $created_by 创建人 
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 * @property int $pid
 */
//class Comment extends \yii\db\ActiveRecord
class Comment extends \strong\models\base\Mysql
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by','pid'], 'integer'],
            [['content'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'content' => Yii::t('app', '内容'),
            'created_by' => Yii::t('app', '创建人'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '最后修改时间'),
            'pid' => Yii::t('app', 'Pid'),
        ];
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }

    public function getContentShow($showLen = 10)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        return mb_substr($tmpStr, 0, $showLen) . ( $tmpLen > $showLen ? '...': '');
    }
}
