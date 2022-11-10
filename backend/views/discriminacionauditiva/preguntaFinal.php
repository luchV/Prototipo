<?php

use common\widgets\PreguntaFinal;

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

        <!-- Un widget que se utiliza para mostrar el resultado final de la prueba. -->
        <?= PreguntaFinal::widget([
            'TextoTitulo' => 'Buen trabajo',
            'iconoTitulo' => 'fas fa-hand-holding-heart',
            'primerCampo' => 'Nombre Estudiante:',
            'textoPrimerCampo' => Yii::$app->user->identity->nombre1 . " " . Yii::$app->user->identity->apellido1,
            'segundoCampo' => 'Total de respuestas correctas:',
            'textoSegundoCampo' => $totalCorrecto,
            'tercerCampo' => 'Total de respuestas incorrectas:',
            'textoTercerCampo' => $totalErrores,
            'redireccion' => '../web/index',
            'textoBoton' => 'Inicio',
        ]); ?>
    </div>
</div>