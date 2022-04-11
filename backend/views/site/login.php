<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
?>
<div class="site-login">

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="row">
        <section class="form-login">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Please fill out the following fields to login:</p>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'controls', 'placeholder' => 'Correo']) ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'controls', 'placeholder' => 'Contraseña']) ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            <p></p>
        </section>
    </div>
    <?php ActiveForm::end(); ?>
</div>