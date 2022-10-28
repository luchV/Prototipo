<?php

use common\helpers\FuncionesGenerales;
use common\models\Institucion;
use common\models\Params;
use common\models\Roles;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\ContenedorTablas;
use common\widgets\BotonActualizarEliminar;



/* @var $this yii\web\View */

if (($model->usuEncargado == Yii::$app->user->identity->usuCodigo || $rolActivo[0]['rolNumero'] == '2') || ($rolActivo[0]['rolNumero'] == '3' && $model->insCodigo == Yii::$app->user->identity->insCodigo)) {

    $this->title = $model->nombre1 . ' ' . $model->apellido1;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;

    if ($model->estado == Params::ESTADOINACTIVO) {
        $botonDesactivar = false;
    }

    if ($rolActivo[0]['rolNumero'] == "2" || $rolActivo[0]['rolNumero'] == "3") {
        $activarBoton = true;
    }
?>
    <div class="usuarios-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= BotonActualizarEliminar::widget([
            'editarBoton' => true,
            'desactivarBoton' => $botonDesactivar ?? true,
            'accionDesactivar' => 'disabled',
            'mensajeMuestraDesactivar' => 'Está seguro que desea desactivar',
            'eliminarBoton' => $activarBoton ?? false,
            'accionEliminar' => 'delete',
            'mensajeMuestraEliminar' => 'Está seguro que desea eliminar permanentemente el usuario, se eliminaran todas las relaciones que tiene vinculado',
            'idBoton' => (string)$model->usuCodigo,
            'mensajeNombre' => $this->title,
            'controller' => 'usuarios',
        ]); ?>

        <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"></div>

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
                        return isset($usuario[0]['nombre1']) ? $usuario[0]['nombre1'] . ' ' . $usuario[0]['apellido1'] : null;
                    },
                ],
                'correo',
            ],
        ]) ?>
        <?php ContenedorTablas::end();  ?>

    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-12">
            <h4>No puede actualizar este usuario sin permiso, por favor contáctese con el super administrador.</h4>
        </div>
    </div>
<?php } ?>