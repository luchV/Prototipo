<?php

use common\helpers\FuncionesGenerales;
use common\models\Institucion;
use common\models\Modulos;
use common\models\SeccionesModulos;
use common\models\User;
use common\widgets\BotonBuscar;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;
use common\widgets\GraficoBarras;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app', 'Reporte de usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repporte-general">

    <div class="row">
        <div class="col-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['action' => "javascript:void(window.location.href='index.php?r=reportes/reporte-busqueda&cedulaBusqueda='+$('#cedulaUsuario').val())"]); ?>
    <?= BotonBuscar::widget([
        'textoBusqueda' => 'Buscar estudiante:',
        'textoBoton' => 'Consultar',
        'idInput' => 'cedulaUsuario',
        'nameInput' => 'User[cedula]',
        'nameButton' => 'busquedaUsuario',
        'longitudMaximaInput' => '13',
        'longitudMinimaInput' => '10',
        'valorInput' => $cedulaUsuario,
    ]); ?>
    <?php ActiveForm::end(); ?>

    <?php if ($mensajeError == "") { ?>

        <?php if ($modelUsuario != null) { ?>
            <h4 style="text-align: initial;font-weight: bold;">Datos del estudiante</h4>
            <div class="row">
                <div class="col-md-6">
                    <strong>Nombre:</strong>
                    <?= $modelUsuario->nombre1 . " " .  $modelUsuario->apellido1 ?>
                </div>
                <div class="col-md-6">
                    <strong>Cédula:</strong>
                    <?= $modelUsuario->cedula ?>
                </div>
                </br>
                </br>
                <div class="col-md-12">
                    <strong>Correo Electrónico: </strong>
                    <?= $modelUsuario->correo ?>
                </div>
            </div>
            </br>
        <?php } ?>

        <?php if ($respuestaGrafico->correcto) { ?>
            <?= GraficoBarras::widget([
                'chartSale' => $respuestaGrafico->chartSale,
            ]);
            ?>
            </br>

        <?php } else { ?>
            <div class="row">
                <div class="col-md-6">
                    No existen registros del estudiante
                </div>
            </div>
            </br>
        <?php } ?>

        </br>
        <?php ContenedorTablas::begin();  ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => 'Mostrando {begin} - {end} de {totalCount} registros. ',
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Número de aciertos',
                    'value' => function ($model) {
                        return $model->numeroAciertos;
                    },
                ],
                [
                    'label' => 'Número de errores',
                    'value' => function ($model) {
                        return $model->numeroErrores;
                    },
                ],
                [
                    'label' => 'Tiempo trascurrido',
                    'value' => function ($model) {
                        return FuncionesGenerales::obtenerTiempoTrascurido($model->tiempoTrascurrido);
                    }
                ],
                [
                    'label' => 'Última actividad',
                    'value' => function ($model) {
                        $seccion = (object)SeccionesModulos::BusquedaSeccionesModulo($model->secCodigo);
                        return 'Actividad ' . $seccion->secNumeroPregunta;
                    },
                ],
                [
                    'label' => 'Edad al momento de prueba',
                    'value' => function ($model) {
                        $usuario = User::busquedaUsuarioCedula($model->usuCodigo);
                        $calculo = FuncionesGenerales::calcular_edad($usuario->edad, $model->fechaEjecucion);

                        return $calculo->edadTexto;
                    },
                ],
                [
                    'attribute' => 'fechaEjecucion',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => 'Ingresar fecha'
                    ]
                ],
                [
                    'attribute' => 'modCodigo',
                    'value' => function ($model) {
                        return Modulos::listarModulosCodigoFiltro()[$model->modCodigo];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'modCodigo', Modulos::listarModulosCodigoFiltro(), ['class' => 'form-control']),

                ],
            ]
        ]); ?>
        <?php ContenedorTablas::end();  ?>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-6">
                <?= $mensajeError ?>
            </div>
        </div>
    <?php } ?>
</div>