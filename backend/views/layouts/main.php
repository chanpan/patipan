<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\cpn\chanpan\assets\bootbox\BootBoxAsset::register($this);
\cpn\chanpan\assets\notify\NotifyAsset::register($this);


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
        'brandLabel' => isset(Yii::$app->params['name_app'])?Yii::$app->params['name_app']:'App',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'ทดสอบเกม', 'url' => ['/game/game-all']]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
    } else {
        $menuItems[] = [
            'label' => 'จัดการครู',
            'icon' => 'users', 'url' => ['/user/admin/index'],
            'visible' => (\Yii::$app->user->can('admin') || \Yii::$app->user->can('teacher')) ? true : false
        ];
        $menuItems[] = [
            'label' => 'จัดการนักเรียน',
            'icon' => 'users', 'url' => ['/student/index'],
            'visible' => (\Yii::$app->user->can('admin') || \Yii::$app->user->can('teacher')) ? true : false
        ];
        $menuItems[] = ['label' => 'จัดการบทเรียน', 'icon' => 'book', 'url' => ['/lessons/index'], 'visible' => !Yii::$app->user->isGuest];
        $menuItems[] = [
            'label' => 'จัดการเกม',
            'icon' => 'users', 'url' => ['/game/index'],
            'visible' => (\Yii::$app->user->can('admin') || \Yii::$app->user->can('teacher')) ? true : false
        ];
        $menuItems[] = [
            'label' => 'ตั้งค่า',
            'icon' => 'users', 'url' => ['/options/index'],
            'visible' => (\Yii::$app->user->can('admin') || \Yii::$app->user->can('teacher')) ? true : false
        ];
        $fullName = \common\modules\user\classes\CNUserFunc::getFullName();
        $img = \common\modules\user\classes\CNUserFunc::getImagePath();
        $menuItems[] = [
            'label' =>"<img src='{$img}' class='user-image' style='width:20px;border-radius:10px;'> ".$fullName,
            'visible' => !Yii::$app->user->isGuest,
            'items' => [
                ['label' => '<i class="fa fa-user"></i> '.Yii::t('appmenu','User Profile'), 'url' => ['/user/settings/profile']],
                '<li class="divider"></li>',
                ['label' => '<i class="fa fa-sign-out"></i> '.Yii::t('appmenu','Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'get']],
            ],
        ];
    }
    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <br/><br/><br/>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
