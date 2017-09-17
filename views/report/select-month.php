<?php

/* @var $months array */

use yii\helpers\Html;

$this->title = 'Выбор периода отчета';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="select-month">
    <div class="row">
        <div class="col-md-8">
            <h3 class="alert-heading"><b>Выберите месяц для отображения детализированного отчета</b></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php foreach($months as $month): ?>
                <?= Html::a($month->group_date, ['detail', 'month' => $month->group_date], ['class' => 'btn btn-default btn-lg btn-block'])?>
            <?php endforeach; ?>
        </div>
    </div>
</div>