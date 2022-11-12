<?php

use common\models\Modulos;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Configuración de módulos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Modulos-index">

    <div class="row">
        <div class="col-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?php ContenedorTablas::begin();  ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} módulos. ',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
            [
                'attribute' => 'modNombre',
                'filter' => Html::activeDropDownList($searchModel, 'modNombre', Modulos::listarModulosFiltro(), ['class' => 'form-control']),
            ],
        ],
    ]); ?>
    <?php ContenedorTablas::end();  ?>

</div>