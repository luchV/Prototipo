<?php

use common\helpers\FuncionesGenerales;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\ContenedorTablas;
use common\widgets\BotonActualizarEliminar;


/* @var $this yii\web\View */
/* @var $model common\models\Banners */

$this->title = $model->insNombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instituciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institucion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= BotonActualizarEliminar::widget([
        'editarBoton' => true,
        'eliminarBoton' => true,
        'idBoton' => (string)$model->insCodigo,
        'mensajeEliminar' => $model->insNombre
    ]); ?>

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