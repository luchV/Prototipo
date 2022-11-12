<?php

use common\helpers\FuncionesGenerales;
use common\models\Institucion;
use common\models\Modulos;
use common\models\SeccionesModulos;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;
use common\widgets\CalendarioBusqueda;
use common\widgets\GraficoBarras;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app', 'Reporte General');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repporte-general">

    <div class="row">
        <div class="col-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>



    <?= CalendarioBusqueda::widget([
        'fechaSeleccionada' => $fecha,
        'nameFecha' => 'Reportes[fechaEjecucion]',
        'idFecha' => 'date_range',
    ]); ?>
    <?php ActiveForm::end(); ?>
    <?php if ($respuestaGrafico->correcto) { ?>
        <?= GraficoBarras::widget([
            'chartSale' => $respuestaGrafico->chartSale,
        ]);
        ?>
        </br>

    <?php } else { ?>
        <div class="row">
            <div class="col-md-6">
                No existen datos en esas fechas
            </div>
        </div>
        </br>
    <?php } ?>

    <?php ContenedorTablas::begin();  ?>
    <?php
    $gridView = [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} registros. ',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Nombre de Usuario',
                'value' => function ($model) {
                    $usuarioBusqueda = User::findIdentity($model->usuCodigo);
                    return $usuarioBusqueda['nombre1'] . ' ' . $usuarioBusqueda['apellido1'];
                },
            ],
            [
                'label' => 'Cédula',
                'value' => function ($model) {
                    $usuarioBusqueda = User::findIdentity($model->usuCodigo);
                    return $usuarioBusqueda['cedula'];
                },
            ],
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
    ];

    if ($busquedaInstitucion) {
        $acciones =
            [
                'attribute' => 'insCodigo',
                'value' => function ($model) {
                    return Institucion::listarInstituciones()[$model->insCodigo];
                },
                'filter' => Html::activeDropDownList($searchModel, 'insCodigo', Institucion::listarInstitucionesFiltro(), ['class' => 'form-control']),
            ];
        array_push($gridView['columns'], $acciones);
    }
    ?>
    <?=
    GridView::widget($gridView); ?>
    <?php ContenedorTablas::end();  ?>


</div>