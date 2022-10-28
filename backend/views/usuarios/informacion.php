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

$this->title = $model->nombre1 . ' ' . $model->apellido1;
$this->params['breadcrumbs'][] = 'Perfil de usuario';
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"></div>

    <?php ContenedorTablas::begin();  ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre1',
            'apellido1',
            [
                'attribute' => 'edad',
                'label' => 'Edad',
                'value' => function ($model) {
                    return FuncionesGenerales::calcularEdad($model->edad);
                },
            ],
            'cedula',
            [
                'attribute' => 'insCodigo',
                'value' => function ($model) {
                    return Institucion::listarInstituciones()[$model->insCodigo];
                },
            ],
            [
                'attribute' => 'rolCodigo',
                'value' => function ($model) {
                    return Roles::listarRoles()[$model->rolCodigo];
                },
            ], 
            'correo',
        ],
    ]) ?>
    <?php ContenedorTablas::end();  ?>

</div>