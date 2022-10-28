<?php

use common\helpers\FuncionesGenerales;
use common\models\Params;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\ContenedorTablas;
use common\widgets\BotonActualizarEliminar;


/* @var $this yii\web\View */

$this->title = $model->insNombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instituciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($model->insEstado == Params::ESTADOINACTIVO) {
    $botonDesactivar = false;
}

if ($rolActivo[0]['rolNumero'] == "2" || $rolActivo[0]['rolNumero'] == "3") {
    $activarBoton = true;
}
?>
<div class="institucion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= BotonActualizarEliminar::widget([
        'editarBoton' => true,
        'desactivarBoton' => $botonDesactivar ?? true,
        'accionDesactivar' => 'disabled',
        'mensajeMuestraDesactivar' => 'Está seguro que desea desactivar',
        'eliminarBoton' => $activarBoton ?? false,
        'accionEliminar' => 'delete',
        'mensajeMuestraEliminar' => 'Está seguro que desea eliminar permanentemente la institución, se eliminaran todas las relaciones que tiene vinculado',
        'idBoton' => (string)$model->insCodigo,
        'mensajeNombre' => $this->title,
        'controller' => 'institucion',
    ]); ?>

    <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"></div>

    <?php ContenedorTablas::begin();  ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'insNombre',
            'ubicación',
            [
                'attribute' => 'insEstado',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposEstados()[$model->insEstado];
                },
            ],
        ],
    ]) ?>
    <?php ContenedorTablas::end();  ?>

</div>