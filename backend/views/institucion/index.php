<?php

use common\helpers\FuncionesGenerales;
use common\widgets\BotonAgregar;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Instituciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institucion-index">

    <div class="row">
        <div class="col-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>


    <?= BotonAgregar::widget([
        'textoBoton' => 'Agregar Institución',
        'accionRealizar' => ['create'],
        'iconoBoton' => '<em class="fa fa-plus"></em>'
    ]); ?>


    <?php ContenedorTablas::begin();  ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} instituciones. ',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{view}',
            ],
            [
                'attribute' => 'insNombre',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Ingresar nombre'
                ]
            ],
            [
                'attribute' => 'ubicación',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Ingresar ubicación'
                ]
            ],
            [
                'attribute' => 'insEstado',
                'value' => function ($model) {
                    return FuncionesGenerales::TiposEstados()[$model->insEstado];
                },
                'filter' => Html::activeDropDownList($searchModel, 'insEstado', FuncionesGenerales::TiposEstados(), ['class' => 'form-control']),
            ],
        ],
    ]); ?>
    <?php ContenedorTablas::end();  ?>

</div>