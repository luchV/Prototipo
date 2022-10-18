<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */

$this->title = Yii::t('app',  'Actualizar: ', [
    'modelClass' => 'Usuario',
]) . ' ' . $model->nombre1 . " " . $model->apellido1;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre1 . " " . $model->apellido1, 'url' => ['view', 'id' => (string)$model->usuCodigo]];
$this->params['breadcrumbs'][] =  Yii::t('app', 'Actualizar');
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