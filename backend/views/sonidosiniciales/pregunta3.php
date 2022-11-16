<?php

use common\helpers\ConsultasGenerales;
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

$funcionSoloVoz = 'realizarReconocimientoMultipleOrdenado';
$soloVoz = '';
if ($modelSeccion->secTipoRespuesta == 'voz') {
    $funcionSoloVoz = 'realizarReconocimientSoloVoz';
    $soloVoz = 'disabled';
    $textoComienzo = 'Desactivar micrófono';
}
$funcionEnvioRespuestas = 'cambiarPreguntaSinOrden';
if ($modelSeccion->secTipoRespuesta == 'ambos') {
    $funcionEnvioRespuestas = 'cambiarPreguntaEspecialSinOrden';
}
$textoBotton = 'Siguiente';
if ($accion == 'pregunta-final') {
    $textoBotton = 'Finalizar';
}
$modelRespuestasSuper = ConsultasGenerales::findModelRespuestaConteoEspecial($modelSeccion->secCodigo);
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
            ]); ?>

            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
                    $arrayDesorden = [];
                    //Desordenar
                    foreach ($modelRespuestas as $imagenes) {
                        array_push($arrayDesorden, ['respuestaTexto' => $imagenes["respuestaTexto"], 'imagen' => $imagenes["imagen"]]);
                    }
                    shuffle($arrayDesorden);
                    $cont = 0;
                    $countAux = 0;
                    foreach ($arrayDesorden as $imagenes) {
                        if ($countAux > 3) {
                            $countAux = 0;
                    ?>
                            <br />
                        <?php
                        }
                        ?>
                        <label id="lab<?= $cont ?>" style="display:none;">
                            <label class="checkeable" style="margin: 2%;" id="label<?= $cont ?>">
                                <input type="radio" style="display:none;" id="cap<?= $cont ?>" onclick="uncheckRadio(this)" name="seleccionImagen<?= $cont ?>" value='<?= $imagenes["respuestaTexto"] ?>' />
                                <img src='https://drive.google.com/uc?export=view&id=<?= $imagenes["imagen"] ?>' height="151px" width="151px" hspace="25">
                            </label>
                        </label>
                    <?php
                        $countAux++;
                        $cont++;
                    }
                    ?>
                    <input id="cantidadOpciones" style="display:none;" value="<?= ($cont) ?>">
                </div>
            </div>

            <!-- Un widget que se utiliza para mostrar el botón "Intentar de nuevo". -->
            <?= CamposImagenes::widget([
                'modelRespuestas' => $modelRespuestasSuper,
                'totalRespuestas' => count((array)$modelRespuestasSuper),
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
                'funcionSiguiente' => $funcionEnvioRespuestas,
                'controllador' => 'sonidosiniciales',
                'accion' => $accion,
                'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
            ]); ?>

            <!-- Un widget que se utiliza para mostrar el botones. -->
            <?= BotonesCRC::widget([
                'funcionRepetir' => 'repetirImagenes9',
                'funcionContinuar' => 'siguientePregunta7',
                'totalFotos' => count($modelRespuestas),
                'totalFotosSegundo' => count($modelRespuestas),
                'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
            ]); ?>

            <!-- Un widget que se utiliza para mostrar el botón "Intentar de nuevo". -->
            <?= IntentaloNuevamente::widget([
                'funcionRepetir' => 'repetirImagenes9',
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
<script src="js/reconocimiento.js" type="text/javascript">
</script>
<script src="js/accionsPreguntas.js" type="text/javascript">
</script>