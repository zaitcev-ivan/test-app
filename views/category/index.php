<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <p>
        <?= Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute'=>'id',
                        'contentOptions' => ['style' => 'width: 65px; max-width: 65px;'],
                    ],
                    'name',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>