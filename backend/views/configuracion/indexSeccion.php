<?php

use common\helpers\FuncionesGenerales;
use common\widgets\BotonAgregar;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Configuración de actividad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración de módulos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-index">

    <div class="row">
        <div class="col-12">
            <h1><?= Html::encode($this->title . ': ' . $modelID->modNombre) ?></h1>
        </div>
    </div>
    <?php if ($dataProvider->getTotalCount() < 5) { ?>
        <?= BotonAgregar::widget([
            'textoBoton' => 'Agregar Actividad',
            'accionRealizar' => ['create-pregunta', 'idModulo' => $modelID->modCodigo],
            'iconoBoton' => '<em class="fa fa-plus"></em>'
        ]); ?>
    <?php } ?>

    <?php ContenedorTablas::begin();  ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} preguntas. ',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}{view}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        $url = str_replace("myButton", "update-pregunta", $url);
                        return Html::a('', $url, ['class' => 'fas fa-pencil-alt', 'data-pjax' => 0, 'title' => "Update", 'title' => "Update", 'aria-label' => "Update"]);
                    }
                ]
            ],
            [
                'attribute' => 'secNumeroPregunta',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposActividades()[$model->secNumeroPregunta];
                },
                'filter' => Html::activeDropDownList($searchModel, 'secNumeroPregunta', FuncionesGenerales::TiposActividades(), ['class' => 'form-control']),
            ],
            [
                'attribute' => 'secPregunta',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Ingresar orden principal'
                ]
            ],
            [
                'attribute' => 'secTipoRespuesta',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposPreguntas()[$model->secTipoRespuesta];
                },
                'filter' => Html::activeDropDownList($searchModel, 'secTipoRespuesta', FuncionesGenerales::TiposPreguntas(), ['class' => 'form-control']),
            ],
            [
                'attribute' => 'secEstado',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposEstados()[$model->secEstado];
                },
                'filter' => Html::activeDropDownList($searchModel, 'secEstado', FuncionesGenerales::TiposEstados(), ['class' => 'form-control']),
            ]
        ],
    ]); ?>
    <?php ContenedorTablas::end();  ?>

</div>