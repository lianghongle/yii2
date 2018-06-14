<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Admin',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    if(Yii::$app->user->isGuest){
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
    }else{
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            [
                'label' => yii::t('app', 'Post'),
                'items' => [
                    [
                        'label' => yii::t('app', 'Post Management'),
                        'url' => '/blog/post/index',
//                        'linkOptions' => ['class'=>"badge badge-inverse"],
//                        'options' => ['class'=>"badge badge-inverse"],
                    ],
                    '<li><span class="badge badge-inverse">3</span></li>',
                    ['label' => yii::t('app', 'Comment Management'), 'url' => '/blog/comment/index'],
                ],
            ],
            [
                'label' => '用户',
                'items' => [
                    [
                        'label' => '用户',
                        'url' => '/user/index',
                    ],
                ],
            ],
            [
                'label' => '系统',
                'items' => [
                    [
                        'label' => '权限',
                        'url' => '/admin',
                    ],
                ],
            ],
        ];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
