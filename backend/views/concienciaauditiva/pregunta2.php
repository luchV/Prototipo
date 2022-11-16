<?php

use common\widgets\BotonesCRC;
use common\widgets\BotonSiguiente;
use common\widgets\CampoAudio;
use common\widgets\CamposImagenes;
use common\widgets\CampoVoz;
use common\widgets\IntentaloNuevamente;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $modelModulo->modNombre;
$this->params['breadcrumbs'][] = $this->title;

$soloVoz = '';
if ($modelSeccion->secTipoRespuesta == 'voz') {
    $soloVoz = 'disabled';
}

$textoBotton = 'Siguiente';
if ($accion == 'pregunta-final') {
    $textoBotton = 'Finalizar';
}
?>

<div id="contenedor-Preguntas">
    <input id="codigoPregunta" name="codigoPregunta" type='hidden' value="<?= $modelSeccion->secCodigo ?>">
    <div class="Menus-create">
        <div class="name-tag">
            <h1><?= $this->title ?></h1>
        </div>
        <br>
        <div class="row">
            <div class="col-md-11-2">
                <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"></div>

                <!-- Un widget que se utiliza para mostrar el audio y el texto de la Pregunta. -->
                <?= CampoAudio::widget([
                    'idDivGeneral' => 'pregunta',
                    'audioCargado' => $modelSeccion->seccAudioPregunta,
                    'idAudio' => 'audioPegunta',
                    'idIconoButton' => 'iconoButtonPregunta',
                    'idLabel' => 'preguntaID',
                    'textoCampo' => $modelSeccion->secPregunta,
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el audio y el texto de la SupPregunta. -->
                <?= CampoAudio::widget([
                    'idDivGeneral' => 'subPregunta',
                    'audioCargado' => $modelSeccion->seccAudioSubPregunta,
                    'idAudio' => 'audioSupPegunta',
                    'idIconoButton' => 'iconoButtonSubPregunta',
                    'idLabel' => 'subpreguntaID',
                    'textoCampo' => $modelSeccion->seccSubpregunta,
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el micrófono y el texto. -->
                <?= CampoVoz::widget([
                    'textoCampo1' => 'Desactivar micrófono',
                    'funcionVoz' => 'activarMicroCambioTexto2',
                    'totalRespuestas' => count($modelRespuestas),
                    'ocultarCampoGeneral' => 'style="display:none;"',
                    'funcionActiva' => 'realizarReconocimientSoloVoz',
                    'soloVoz' => $soloVoz,
                    'vozActiva' => 'checked'
                ]); ?>
                <br>

                <!-- Un widget que se utiliza para mostrar las imágenes y el texto. -->
                <?= CamposImagenes::widget([
                    'modelRespuestas' => $modelRespuestas,
                    'totalRespuestas' => count($modelRespuestas),
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el botón "Intentar de nuevo". -->
                <?= IntentaloNuevamente::widget([
                    'habilitarTexto' => true
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el botón "Buen trabajo". -->
                <?= IntentaloNuevamente::widget([
                    'textoMostrar' => 'Buen trabajo ',
                    'iconoMostrar' => 'fas fa-arrow-right',
                    'textoBoton' => $textoBotton . ' ',
                    'idMensajes' => 'mostrarMensajeInformativo',
                    'idLabel' => 'buenTrabajo',
                    'habilitarTexto' => true
                ]); ?>
            </div>
            <div class="col-md-1-2">

                <!-- Un widget que se utiliza para mostrar el siguiente botón. -->
                <?= BotonSiguiente::widget([
                    'textoBotton' => $textoBotton,
                    'funcionSiguiente' => 'cambiarPregunta',
                    'controllador' => 'concienciaauditiva',
                    'accion' => $accion,
                    'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el botones. -->
                <?= BotonesCRC::widget([
                    'funcionRepetir' => 'repetirImagenes7',
                    'funcionContinuar' => 'siguientePregunta6',
                    'totalFotos' => count($modelRespuestas),
                    'totalFotosSegundo' => count($modelRespuestas),
                    'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el botón "Intentar de nuevo". -->
                <?= IntentaloNuevamente::widget([
                    'funcionRepetir' => 'repetirImagenes7',
                    'numeroTotal' => count($modelRespuestas),
                    'TipoRespuestas' => $modelSeccion->secTipoRespuesta,
                    'habilitarBoton' => true,
                    'idMensajes' => 'MensajeRespuesta2'
                ]); ?>

                <!-- Un widget que se utiliza para mostrar el botón "Buen trabajo". -->
                <?= IntentaloNuevamente::widget([
                    'funcionRepetir' => 'mostrarCampos',
                    'numeroTotal' => count($modelRespuestas),
                    'TipoRespuestas' => $modelSeccion->secTipoRespuesta,
                    'iconoMostrar' => 'fas fa-arrow-right',
                    'textoBoton' => $textoBotton,
                    'idMensajes' => 'mostrarMensajeInformativo2',
                    'habilitarBoton' => true
                ]); ?>
            </div>
        </div>
    </div>
</div>
    <script src="js/reconocimiento.js" type="text/javascript">
    </script>
    <script src="js/accionsPreguntas.js" type="text/javascript">
    </script>