<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Actualizar: ') . 'Actividad ' . $model->secNumeroPregunta;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración de módulos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración de actividad'), 'url' => ['update', 'id' => $modelID->modCodigo]];
$this->params['breadcrumbs'][] = ['label' => $modelID->modNombre . ' : Actividad ' . $model->secNumeroPregunta, 'url' => ['view', 'id' => $model->secCodigo]];
$this->params['breadcrumbs'][] = $this->title;
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
        'modelRespuestaMuestra' => $modelRespuestaMuestra,
        'activado' => $activado,
    ]) ?>

</div>