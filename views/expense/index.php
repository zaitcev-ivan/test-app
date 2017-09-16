<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\source\entities\Expense;


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
                        'value' => function (Expense $model) {
                            return $model->created_at;
                        },
                        'contentOptions' => ['style' => 'width: 180px; max-width: 180px;'],
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>