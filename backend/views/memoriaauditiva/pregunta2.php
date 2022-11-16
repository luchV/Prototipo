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
$funcionSoloVoz = 'realizarReconocimientoMultipleOrdenado';
$vozActiva = '';
if ($modelSeccion->secTipoRespuesta == 'voz') {
    $soloVoz = 'disabled';
    $funcionSoloVoz = 'realizarReconocimientSoloVoz';
    $vozActiva = 'checked';
    $textoComienzo = 'Desactivar micrófono';
}

$funcionEnvioRespuestas = 'cambiarPregunta';
if ($modelSeccion->secTipoRespuesta == 'ambos') {
    $funcionEnvioRespuestas = 'cambiarPreguntaEspecialOrden';
}

$textoBotton = 'Siguiente';
if ($accion == 'pregunta-final') {
    $textoBotton = 'Finalizar';
}
?>

<div id="contenedor-Preguntas">
    <input id="codigoPregunta" name="codigoPregunta" type='hidden' value="<?= $modelSeccion->secCodigo ?>">
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
                'ocultarCampo' => 'style="display:none;"',
                'idAudio' => 'audioSupPegunta',
                'idIconoButton' => 'iconoButtonSubPregunta',
                'idLabel' => 'subpreguntaID',
                'textoCampo' => $modelSeccion->seccSubpregunta,
            ]); ?>
            <br>

            <!-- Un widget que se utiliza para mostrar el micrófono y el texto. -->
            <?= CampoVoz::widget([
                'textoCampo1' => $textoComienzo ?? 'Activar micrófono',
                'funcionVoz' => 'activarMicroCambioTexto3',
                'totalRespuestas' => count($modelRespuestas),
                'ocultarCampoGeneral' => 'style="display:none;"',
                'oculptarCampoMicro' => 'style="display:none;"',
                'funcionActiva' => $funcionSoloVoz,
                'soloVoz' => $soloVoz,
                'vozActiva' => $vozActiva
            ]); ?>

            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
                    $cont = 0;
                    foreach ($modelRespuestas as $imagenes) {
                        if (filter_var($imagenes->respuestaCorrecto, FILTER_VALIDATE_BOOLEAN)) {
                    ?>
                            <label id="lab<?= $cont ?>">
                                <label class="color-fotos" style="margin: 2%;" id="label<?= $cont ?>">
                                    <input type="radio" style="display:none;" id="cap<?= $cont ?>" name="seleccionImagen<?= $cont ?>" value='<?= $imagenes["respuestaTexto"] ?>' />
                                    <img src='https://drive.google.com/uc?export=view&id=<?= $imagenes["imagen"] ?>' height="151px" width="151px" hspace="25">
                                </label>
                            </label>
                    <?php
                            $cont++;
                        }
                    }
                    ?>
                    <input id="cantidadOpciones" style="display:none;" value="<?= ($cont - 1) ?>">
                </div>
            </div>

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
            </br>
            </br>
        </div>

        <div class="col-md-1-2">
            <!-- Un widget que se utiliza para mostrar el siguiente botón. -->
            <?= BotonSiguiente::widget([
                'textoBotton' => $textoBotton,
                'funcionSiguiente' => $funcionEnvioRespuestas,
                'controllador' => 'memoriaauditiva',
                'accion' => $accion,
                'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
            ]); ?>

            <!-- <button class="btn btn-primary text-center estilo-Personalizado-B" id="btmContinuar" onclick="siguientePregunta3(<?= count($modelRespuestas) ?>,'<?= $modelSeccion->secTipoRespuesta ?>')" title="Continuar"><em class="fas fa-angle-double-right"></em></button> -->

            <!-- Un widget que se utiliza para mostrar el botones. -->
            <?= BotonesCRC::widget([
                'funcionRepetir' => 'repetirImagenes5',
                'funcionContinuar' => 'siguientePregunta3',
                'totalFotos' => count($modelRespuestas),
                'totalFotosSegundo' => count($modelRespuestas),
                'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
            ]); ?>

            <!-- Un widget que se utiliza para mostrar el botón "Intentar de nuevo". -->
            <?= IntentaloNuevamente::widget([
                'funcionRepetir' => 'repetirImagenes5',
                'numeroTotal' => $cont,
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
<script src="js/reconocimiento.js" type="text/javascript">
</script>
<script src="js/accionsPreguntas.js" type="text/javascript">
</script>