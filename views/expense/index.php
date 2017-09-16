<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\source\entities\Expense;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-index">

    <p>
        <?= Html::a('Создать новый расход', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute'=>'id',
                        'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],
                        'value' => function(Expense $model) {
                            return $model->id;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'filter' => $searchModel->categoriesList(),
                        'value' => function(Expense $model) {
                            return Html::encode($model->category->name);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute'=>'amount',
                        'contentOptions' => ['style' => 'width: 65px; max-width: 65px;'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                'weekStart' => 1,
                            ],
                        ]),
                        'value' => function(Expense $model) {
                            return date("d M Y", $model->created_at);
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