<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Crear actividad: ') . ' ' . $modelID->modNombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración de módulos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración de actividad'), 'url' => ['update', 'id' => $modelID->modCodigo]];
$this->params['breadcrumbs'][] = 'Crear actividad';
?>
<div class="configuracion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelID' => $modelID,
        'totalPreguntas' => $totalPreguntas,
        'totalRespuestas' => $totalRespuestas,
        'modelRespuestas' => $modelRespuestas,
        'errorMensaje' => $errorMensaje,
        'activado' => $activado,
    ]) ?>

</div>