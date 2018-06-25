<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="admin-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'current')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'new')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirm')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
