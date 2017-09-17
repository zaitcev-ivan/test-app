<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Приложение для учета личных расходов';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if (Yii::$app->user->isGuest) :?>
        <h1>Добро пожаловать</h1>
        <p class="lead">в приложение для учета расходов</p>
        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['auth/login'])?>">Войдите</a></p>
        <p class="lead">или</p>
        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['signup/request'])?>">Зарегистрируйтесь</a></p>
        <p class="lead">чтобы начать работу</p>
        <?php else: ?>
            <h1>Приложение для учета расходов</h1>
            <p class="lead">Чтобы начать работать, </p>
            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['category/create'])?>">Создайте категории затрат</a></p>
            <p class="lead">После этого</p>
            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['expense/create'])?>">Добавляйте текущие расходы</a></p>
            <p class="lead">Периодически наблюдайте за</p>
            <p><a class="btn btn-lg btn-success" href="<?=Url::to(['report/monthly'])?>">Отчетами</a></p>
            <p class="lead">И корректируйте свою финансовую деятельность!</p>
        <?php endif; ?>
    </div>

    <div class="body-content">

    </div>
</div>
