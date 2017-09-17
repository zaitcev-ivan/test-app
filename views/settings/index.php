<?php

/* @var $this yii\web\View */
/* @var $model \app\source\forms\SettingsEditForm */

use app\source\helpers\SettingsHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-settings">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'scenario')->dropDownList(SettingsHelper::scenarioList()) ?>

            <?= $form->field($model, 'limit_sum') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>