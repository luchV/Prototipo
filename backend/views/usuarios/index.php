<?php

use common\helpers\FuncionesGenerales;
use common\models\Institucion;
use common\models\Roles;
use common\widgets\BotonAgregar;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <div class="row">
        <div class="col-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>


    <?= BotonAgregar::widget([
        'textoBoton' => 'Agregar Usuario',
        'accionRealizar' => 'create',
        'iconoBoton' => '<em class="fa fa-plus"></em>'
    ]); ?>


    <?php ContenedorTablas::begin();  ?>
    <?php
    $gridView = [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} usuarios. ',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{view}',
            ],
            'nombre1',
            'apellido1',
            'correo',
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposEstados()[$model->estado];
                },
                'filter' => Html::activeDropDownList($searchModel, 'estado', ['' => 'Todos', 'N' => 'Activado', 'P' => 'Inactivo'], ['class' => 'form-control']),
            ],
        ],
    ];

    if ($rolActivo == '2') {
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

    if ($rolActivo == '2' || $rolActivo == '3') {
        $acciones =
            [
                'attribute' => 'rolCodigo',
                'value' => function ($model) {
                    return Roles::listarRoles()[$model->rolCodigo];
                },
                'filter' => Html::activeDropDownList($searchModel, 'rolCodigo', Roles::detectarRoles($rolActivo), ['class' => 'form-control']),
            ];
        array_push($gridView['columns'], $acciones);
    }

    ?>
    <?= GridView::widget($gridView) ?>
    <?php ContenedorTablas::end();  ?>

</div>

<script>

</script>