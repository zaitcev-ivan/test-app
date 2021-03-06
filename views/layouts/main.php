<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

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
        'brandLabel' => 'Учет расходов',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'О сайте', 'url' => ['/site/about']];
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['signup/request']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['auth/login']];
    } else {
        $menuItems[] = ['label' => 'Категории', 'url' => ['category/index']];
        $menuItems[] = ['label' => 'Расходы', 'url' => ['expense/index']];
        $menuItems[] = ['label' => 'Отчеты', 'items' => [
            ['label' => 'Сводный отчет', 'url' => ['report/monthly']],
            ['label' => 'Отчет по месяцам', 'url' => ['report/select-month']],
        ]];
        $menuItems[] = ['label' => 'Настройки', 'url' => ['settings/index']];
        $menuItems[] = ['label' => 'Предельные суммы', 'url' => ['limit/index']];
        $menuItems[] = ['label' => 'О сайте', 'url' => ['/site/about']];
        $menuItems[] = '<li>'
            . Html::beginForm(['auth/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
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
        <p class="pull-left">&copy; Учет расходов <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
