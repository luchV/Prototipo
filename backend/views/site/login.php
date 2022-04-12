<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
?>
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<div class="hand"></div>
<div class="hand rgt"></div>
<h1><?= Html::encode($this->title) ?></h1>
<p>Por favor ingresa los siguientes campos para iniciar sesión:</p>
<?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'placeholder' => 'Correo electrónico']) ?>
<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Contraseña']) ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
<p class="alert">Los campos no pueden</br> estar vacios...!!</p>
<?php ActiveForm::end(); ?>