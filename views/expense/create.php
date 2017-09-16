<?php

/* @var $this yii\web\View */
/* @var $model \app\source\forms\ExpenseCreateForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;

$this->title = 'Создание нового расхода';
$this->params['breadcrumbs'][] = ['label' => 'Расходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'category_id')->dropDownList($model->categoriesList()) ?>
            <label class="control-label">Дата расхода</label>
            <?php echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'created_at',
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                    'weekStart' => 1,
                ]
            ]);
            ?><br>
            <?= $form->field($model, 'amount')->textInput(['maxLength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>