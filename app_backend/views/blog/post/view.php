<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\blog\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'created_at:datetime',
            'updated_at:datetime',
//            'created_at',//"raw", "text", "html", ['date', 'php:Y-m-d']
//            http://www.yiichina.com/doc/api/2.0/yii-i18n-formatter
//            [
//                'attribute' => 'created_at',
//                'label'=>'创建时间',
//                'value'=> date('Y-m-d H:i:s',$model->created_at),
////                'format'=> ['date', 'php:Y-m-d H:i:s'],
//                'headerOptions' => ['width' => '170'],
//            ],
            'status',
            'created_by',
        ],
//        'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
//        'options' => ['class' => 'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
