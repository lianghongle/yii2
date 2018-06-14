<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\blog\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Comment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'content',
            [
                'attribute' => 'content',
                //当前行 对象/键/索引/数据列对象
                'value' => function($model, $key, $index, $column){

                    $showLen = 10;

                    $tmpStr = strip_tags($model->content);
                    $tmpLen = mb_strlen($tmpStr);

                    return mb_substr($tmpStr, 0, $showLen) . ( $tmpLen > $showLen ? '...': '');
                }
            ],
            [
                'label' => 'content2',
                'attribute' => 'content',
                //当前行 对象/键/索引/数据列对象
                'value' => 'ContentShow'
            ],
            [
                'attribute' => 'status',
                'contentOptions' => function($model){
                    return ($model->status == 1) ? ['class'=>'bg-danger'] : [];
                }
            ],
            'created_by',
            'created_at',
            'updated_at',
            // 'pid',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}{approve}',
                'buttons' => [
                    'approve' => function($url, $model, $key){
                        $options = [
                            'title' => '审核',
                            'aria-label' => '审核',
                            'data-confirm' => '确定？',
                            'data-method' => 'post',
                            'data-pjax' => 0,
//                            'controller' => '',//???
                        ];

                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, $options);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
