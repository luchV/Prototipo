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
?>

<div id="contenedor-Preguntas">
    <input id="codigoPregunta" name="codigoPregunta" type='hidden' value="<?= $modelSeccion->secCodigo ?>">
    <div class="Menus-create">

        <!-- Un widget que se utiliza para mostrar el siguiente botón. -->
        <?= BotonSiguiente::widget([
            'textoBotton' => $textoBotton,
            'funcionSiguiente' => $funcionEnvioRespuestas,
            'controllador' => 'sonidosfinales',
            'accion' => $accion,
            'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
        ]); ?>

        <div class="name-tag">
            <h1><?= $this->title ?></h1>
        </div>
        <br>

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


        <!-- Un widget que se utiliza para mostrar el micrófono y el texto. -->
        <?= CampoVoz::widget([
            'textoCampo1' => $textoComienzo ?? 'Activar micrófono',
            'funcionVoz' => 'activarMicroCambioTexto3',
            'totalRespuestas' => count($modelRespuestas),
            'ocultarCampoGeneral' => 'style="display:none;"',
            'oculptarCampoMicro' => 'style="display:none;"',
            'funcionActiva' => 'realizarReconocimientSoloVoz',
            'soloVoz' => $soloVoz,
        ]); ?>
        <br>

        <div class="row">
            <div class="col-md-12 text-center">
                <?php
                $arrayDesorden = [];
                //Desordenar
                foreach ($modelRespuestas as $imagenes) {
                    array_push($arrayDesorden, ['respuestaTexto' => $imagenes["respuestaTexto"], 'imagen' => $imagenes["imagen"]]);
                }
                shuffle($arrayDesorden);
                $countAux = 0;

                $cont = 0;
                foreach ($modelRespuestas as $imagenes) {
                    if ($countAux > 3) {
                        $countAux = 0;
                ?>
                        <br />
                    <?php
                    }
                    ?>
                    <label id="lab<?= $cont ?>" style="display:none;">
                        <button id="idButton<?= $cont ?>" class="btnPersonalizado" onclick='reproducir("<?= $imagenes["respuestaTexto"] ?>", "iconoButton<?= $cont ?>","fas fa-volume-off tamanoIcono", "fas fa-volume-up tamanoIcono")'><em id="iconoButton<?= $cont ?>" class="fas fa-volume-off tamanoIcono"></em></button>
                        <label style="margin: 2%;" id="label<?= $cont ?>">
                            <input type="radio" style="display:none;" id="cap<?= $cont ?>" name="seleccionImagen<?= $cont ?>" value='<?= $imagenes["respuestaTexto"] ?>' />
                            <img src='https://drive.google.com/uc?export=view&id=<?= $imagenes["imagen"] ?>' height="151px" width="151px" hspace="25">
                        </label>
                    </label>
                <?php
                    $cont++;
                    $countAux++;
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
            'funcionRepetir' => 'repetirImagenes',
            'numeroTotal' => $cont,
            'TipoRespuestas' => $modelSeccion->secTipoRespuesta
        ]); ?>

        <!-- Un widget que se utiliza para mostrar el botón "Buen trabajo". -->
        <?= IntentaloNuevamente::widget([
            'funcionRepetir' => 'mostrarCampos',
            'numeroTotal' => count($modelRespuestas),
            'TipoRespuestas' => $modelSeccion->secTipoRespuesta,
            'textoMostrar' => 'Buen trabajo ',
            'iconoMostrar' => 'fas fa-arrow-right',
            'textoBoton' => $textoBotton . ' ',
            'idMensajes' => 'mostrarMensajeInformativo',
            'idLabel' => 'buenTrabajo',
        ]); ?>
    </div>

    <!-- Un widget que se utiliza para mostrar el botones. -->
    <?= BotonesCRC::widget([
        'funcionRepetir' => 'repetirImagenes',
        'funcionContinuar' => 'siguientePregunta3',
        'totalFotos' => $cont,
        'totalFotosSegundo' => count($modelRespuestas),
        'secTipoRespuesta' => $modelSeccion->secTipoRespuesta,
    ]); ?>
</div>
<script src="js/reconocimiento.js" type="text/javascript">
</script>
<script src="js/accionsPreguntas.js" type="text/javascript">
</script>