<?php

use common\helpers\FuncionesGenerales;
use common\models\Institucion;
use common\models\Roles;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\ContenedorTablas;
use common\widgets\BotonActualizarEliminar;


/* @var $this yii\web\View */
/* @var $model common\models\Banners */

$this->title = $model->nombre1 . ' ' . $model->apellido1;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= BotonActualizarEliminar::widget([
        'editarBoton' => true,
        'eliminarBoton' => true,
        'idBoton' => (string)$model->usuCodigo,
        'mensajeEliminar' => $this->title
    ]); ?>

    <?php ContenedorTablas::begin();  ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'edad',
            [
                'attribute' => 'edad',
                'label' => 'Edad',
                'value' => function ($model) {
                    return FuncionesGenerales::calcularEdad($model->edad);
                },
            ],
            'cedula',
            [
                'attribute' => 'tipoDiscapacidad',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposDiscapacidades()[$model->tipoDiscapacidad];
                },
            ],
            [
                'attribute' => 'insCodigo',
                'value' => function ($model) {
                    return Institucion::listarInstituciones()[$model->insCodigo];
                },
            ],
            [
                'attribute' => 'tipoEscuela',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposEscuelas()[$model->tipoEscuela];
                },
            ],
            [
                'attribute' => 'nivelInstruccion',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposInstituciones()[$model->nivelInstruccion];
                },
            ],
            [
                'attribute' => 'nivelEducacion',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposNivelEducacion()[$model->nivelEducacion];
                },
            ],
            [
                'attribute' => 'rolCodigo',
                'value' => function ($model) {
                    return Roles::listarRoles()[$model->rolCodigo];
                },
            ],
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposEstados()[$model->estado];
                },
            ],
            [
                'attribute' => 'usuEncargado',
                'value' => function ($model) {
                    $usuario = User::BusquedaUsuario($model->usuEncargado);
                    return $usuario[0]['nombre1'] . ' ' . $usuario[0]['apellido1'];
                },
            ],
            'correo',
        ],
    ]) ?>
    <?php ContenedorTablas::end();  ?>

</div>