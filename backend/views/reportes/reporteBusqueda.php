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

    <?php $form = ActiveForm::begin(); ?>
    <?= BotonBuscar::widget([
        'textoBusqueda' => 'Buscar socio:',
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
            <h4 style="text-align: initial;font-weight: bold;">Datos del Usuario</h4>
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
            <div class="row">
                <div class="col-lg-12" id="tabla_listadot" style="display: inline">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p class="pull-left label-success" style="margin-right:15px;"><?php echo "Tiempo total trascurrido: " ?></p>
                            <p class="pull-left label-info"><?= FuncionesGenerales::obtenerTiempoTrascurido($respuestaGrafico->totalTiempo); ?></p>
                            <br />
                            <p class="pull-left label-success" style="margin-right:15px;"><?php echo "Número total de errores: " ?></p>
                            <p class="pull-left label-info"><?= $respuestaGrafico->totalError; ?></p>
                            <br />
                            <p class="pull-left label-success" style="margin-right:15px;"><?php echo "Número total de aciertos: " ?></p>
                            <p class="pull-left label-info"><?= $respuestaGrafico->totalAciertos; ?></p>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
            </br>

        <?php } else { ?>
            <div class="row">
                <div class="col-md-6">
                    No existen registros del usuario
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
                    'attribute' => 'numeroAciertos',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => 'Ingresar aciertos'
                    ]
                ],
                [
                    'attribute' => 'numeroErrores',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => 'Ingresar errores'
                    ]
                ],
                [
                    'attribute' => 'fechaEjecucion',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => 'Ingresar fecha'
                    ]
                ],
                [
                    'attribute' => 'tiempoTrascurrido',
                    'value' => function ($model) {
                        return FuncionesGenerales::obtenerTiempoTrascurido($model->tiempoTrascurrido);
                    },
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => 'Ingresar tiempo'
                    ]
                ],
                [
                    'attribute' => 'secCodigo',
                    'value' => function ($model) {
                        $seccion = (object)SeccionesModulos::BusquedaSeccionesModulo($model->secCodigo);
                        return 'Actividad ' . $seccion->secNumeroPregunta;
                    },
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