<?php

use common\models\Institucion;
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
        <div class="row">
            <div class="col-lg-12" id="tabla_listadot" style="display: inline">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="pull-left label-success" style="margin-right:15px;"><?php echo "Tiempo total trascurrido: " ?></p>
                        <p class="pull-left label-info"><?= $respuestaGrafico->totalTiempo; ?></p>
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
            'numeroAciertos',
            'numeroErrores',
            'tiempoTrascurrido',
            'fechaEjecucion',
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