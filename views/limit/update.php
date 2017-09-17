<?php

/* @var $this yii\web\View */
/* @var $model \app\source\forms\CategoryCreateForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Изменить предельную сумму';
$this->params['breadcrumbs'][] = ['label' => 'Ограничения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'limit_sum')->textInput(['maxLength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>