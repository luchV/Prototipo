<?php

use common\widgets\IntentaloNuevamente;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $modelModulo->modNombre;
$this->params['breadcrumbs'][] = $this->title;

$soloVoz = '';
$soloImagenes = '';
$mostrarImagenes = 'style="display:none;"';
if ($modelSeccion->secTipoRespuesta == 'voz') {
    $soloVoz = 'disabled';
}
if ($modelSeccion->secTipoRespuesta == 'imagen') {
    $soloImagenes = 'style="display:none;"';
    $mostrarImagenes = '';
}

$textoBotton = 'Siguiente';
if ($accion == 'pregunta-final') {
    $textoBotton = 'Finalizar';
}
?>

<div id="contenedor-Preguntas">
    <input id="codigoPregunta" name="codigoPregunta" type='hidden' value="<?= $modelSeccion->secCodigo ?>">
    <div class="Menus-create">
        <div class="col-md-12" id="btn_next">
            <br>
            <div class="form-group" style="text-align: end !important;">
                <?= Html::submitButton(Yii::t('app', $textoBotton . ' <em class="fas fa-arrow-right"></em>'), ['class' => 'btn btn-primary text-center', 'onclick' => 'cambiarPregunta("concienciaauditiva","' . $accion . '","' . $modelSeccion->secTipoRespuesta . '","solo")']) ?>
            </div>
        </div>
        <div class="name-tag">
            <h1><?= $this->title ?></h1>
        </div>
        <br>

        <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"></div>

        <div class="row" id='pregunta'>
            <audio id="audioPegunta" preload="metadata">
                <source src="https://docs.google.com/uc?export=open&id=<?= $modelSeccion->seccAudioPregunta  ?>" type="audio/mp3">
            </audio>
            <div class="col-md-12">
                <button class="btnPersonalizado" onclick="reproducirAudioCargado('audioPegunta','iconoButtonPregunta','fas fa-volume-off','fas fa-volume-up')"><em id="iconoButtonPregunta" class="fas fa-volume-off"></em></button>
                <label id="preguntaID" name="preguntaID" class="textoPreguntas">
                    <?= $modelSeccion->secPregunta ?>
                </label>
            </div>
        </div>
        <div class="row" id='subPregunta'>
            <audio id="audioSupPegunta" preload="metadata">
                <source src="https://docs.google.com/uc?export=open&id=<?= $modelSeccion->seccAudioSubPregunta  ?>" type="audio/mp3">
            </audio>
            <div class="col-md-12">
                <button class="btnPersonalizado" onclick="reproducirAudioCargado('audioSupPegunta','iconoButtonSubPregunta','fas fa-volume-off','fas fa-volume-up')"><em id="iconoButtonSubPregunta" class="fas fa-volume-off"></em></button>
                <label id="subpreguntaID" name="subpreguntaID">
                    <?= $modelSeccion->seccSubpregunta ?>
                </label>
            </div>
        </div>
        <div id="mocrofono" <?= $soloImagenes ?>>
            <Label>
                Activar micrófono
            </Label>
            <div class="checkbox-JASoft">
                <input type="checkbox" id="checkAvanzado" value="Valor" onclick="activarMicro(this,<?= count($modelRespuestas) ?>)" <?= $soloVoz ?> checked />
                <label for="checkAvanzado"></label>
            </div>

            <div id="reconocimientoVoz">
                <button class="btnPersonalizado2"><em id="start_img" onclick="realizarReconocimientSoloVoz()" style="cursor: pointer;" class="fas fa-microphone-alt"></em></button>
                <label id="texto" style="display:none;" name="texto"></label>
                <div id="errorMensajestyle="display:none;">
                    <p class="error"></p>
                </div>
            </div>
        </div>
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
                $contRes = 0;
                foreach ($arrayDesorden as $imagenes) {
                ?>
                    <label id="labRes<?= $contRes ?>" <?= $mostrarImagenes ?>>
                        <label class="checkeable" style="margin: 2%;" id="labelRes<?= $contRes ?>">
                            <input type="radio" style="display:none;" id="capRes<?= $contRes ?>" onclick="uncheckRadio(this)" name="seleccionImagenRes<?= $contRes ?>" value='<?= $imagenes["respuestaTexto"] ?>' />
                            <img src='https://drive.google.com/uc?export=view&id=<?= $imagenes["imagen"] ?>' height="151px" width="151px" hspace="25">
                        </label>
                    </label>
                <?php
                    $contRes++;
                }
                ?>
                <input id="cantidadOpcionesRespuesta" style="display:none;" value="<?= count($modelRespuestas) ?>">
            </div>
        </div>
        <?= IntentaloNuevamente::widget([
            'funcionRepetir' => 'repetirImagenes2',
            'numeroTotal' => count($modelRespuestas),
            'TipoRespuestas' => $modelSeccion->secTipoRespuesta
        ]); ?>
    </div>
</div>
<script src="js/reconocimiento.js" type="text/javascript">
</script>
<script src="js/accionsPreguntas.js" type="text/javascript">
</script>