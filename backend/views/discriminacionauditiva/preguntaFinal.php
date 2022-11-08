<?php

use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Boolean;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $modelModulo->modNombre;
$this->params['breadcrumbs'][] = $this->title;
?>
<input id="codigoPregunta" name="codigoPregunta" type='hidden' value="<?= $codigoS ?>">
<link rel="stylesheet" href="css/TablaRespuesta.css" type="text/css" media="all" /> <!-- Style-CSS -->

<div id="contenedor-Preguntas">
    <div class="Menus-create">
        <div class="name-tag">
            <h1><?= $this->title ?></h1>
        </div>
        <br>
        <div class="agileits-pricing-grid third">
            <div class="pricing_grid">
                <div class="wthree-pricing-info pricing-top green-top">
                    <h3>Buen trabajo</h3>
                </div>
                <div class="pricing-bottom">
                    <div class="pricing-bottom-bottom green-pricing-bottom-top" style="text-align: initial;">
                        <p><span class="fas fa-check-double"></span><span>Nombre Estudiante:</span> <?= Yii::$app->user->identity->nombre1 ?> <?= Yii::$app->user->identity->apellido1 ?></p>
                        <p><span class="fas fa-check-double"></span><span>Total de respuestas correctas: </span> <?= $totalCorrecto ?></p>
                        <p><span class="fas fa-times"></span><span>Total de respuestas incorrectas: </span> <?= $totalErrores ?></p>
                    </div>
                    <div class="buy-button">
                        <a href="../web/index" class="link-button">Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>