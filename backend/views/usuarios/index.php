<?php

use common\widgets\BotonAgregar;
use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\ContenedorTablas;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Menus-index">

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
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} usuarios. ',
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre1',
            'apellido1',
            'correo',
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>
    <?php ContenedorTablas::end();  ?>

</div>