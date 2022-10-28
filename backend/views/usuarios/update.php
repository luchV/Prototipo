<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

if (($model->usuEncargado == Yii::$app->user->identity->usuCodigo || $rolActivo[0]['rolNumero'] == '2') || ($rolActivo[0]['rolNumero'] == '3' && $model->insCodigo == Yii::$app->user->identity->insCodigo)) {
    $this->title = Yii::t('app',  'Actualizar: ', [
        'modelClass' => 'Usuario',
    ]) . ' ' . $model->nombre1 . " " . $model->apellido1;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->nombre1 . " " . $model->apellido1, 'url' => ['view', 'id' => (string)$model->usuCodigo]];
    $this->params['breadcrumbs'][] =  Yii::t('app', 'Actualizar');
}
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (($rolActivo == '3' || $rolActivo == '4') && Yii::$app->user->identity->usuCodigo == $model->usuCodigo) {
        if (($rolActivo == '3')) {
            $mensaje = 'No puede actualizar su propio Usuario, por favor contáctese con el Super Administrador.';
        } else {
            $mensaje = 'No puede actualizar su propio Usuario, por favor contáctese con el Administrador.';
        }
    ?>
        <div class="row">
            <div class="col-12">
                <h4><?= $mensaje ?></h4>
            </div>
        </div>
    <?php
    } else if (($model->usuEncargado != Yii::$app->user->identity->usuCodigo && $rolActivo[0]['rolNumero'] != '2' ) && ($rolActivo[0]['rolNumero'] == '3' && $model->insCodigo != Yii::$app->user->identity->insCodigo)) {
    ?>
        <div class="row">
            <div class="col-12">
                <h4>No puede actualizar este usuario sin permiso, por favor contáctese con el super administrador.</h4>
            </div>
        </div>
    <?php
    } else {
    ?>
        <?= $this->render('_form', [
            'model' => $model,
            'errorMensaje' => $errorMensaje,
            'fechaActual' => $fechaActual,
            'parametro' => $parametro,
            'rolesLista' => $rolesLista,
            'institucionLista' => $institucionLista,
            'editar' => $editar,
            'activado' => $activado,
        ]) ?>
    <?php
    }
    ?>
</div>