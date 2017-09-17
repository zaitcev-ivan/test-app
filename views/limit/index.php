<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\source\entities\Limit;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LimitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Конфигурирование предельных сумм';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limit-index">
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute'=>'id',
                        'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],
                        'value' => function(Limit $model) {
                            return $model->id;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'limit_sum',
                        'value' => function(Limit $model) {
                            return Html::encode($model->limit_sum);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'current_sum',
                        'value' => function(Limit $model) {
                            return Html::encode($model->current_sum);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function(Limit $model) {
                            return $model->date;
                        },
                        //'format' => 'datetime',
                        'contentOptions' => ['style' => 'width: 250px; max-width: 250px;'],
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>