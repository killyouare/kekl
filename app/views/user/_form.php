<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="user-form">
    <?php
    $form = Pjax::begin(); ?>
    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput() ?>


    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'repeatPassword')->passwordInput() ?>

    <?= $form->field($model, 'checkMark')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

    <?php
    Pjax::end(); ?>

</div>
