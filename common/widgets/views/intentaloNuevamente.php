<?php

use yii\bootstrap4\Html;

if ($textoBoton == '') {
    $iconoFinal = $iconoMostrar;
} else {
    if ($textoBoton == 'Siguiente') {
        $iconoFinal = $iconoMostrar;
    } else {
        $iconoFinal = 'fas fa-flag-checkered';
    }
}
?>

<?php if ($habilitarTexto) { ?>
    <div id="<?= $idMensajes ?>" name="<?= $idMensajes ?>" style="display:none;">
        <div class="col-md-12" style="text-align: center;">
            <audio id='<?= $textoMostrar == "Inténtalo de nuevo" ? "idCambioAudioC" : "idBuenTrabajo" ?>'>
                <source src="music/<?= $textoMostrar == 'Inténtalo de nuevo' ? 'Intentalo.ogg' : 'buenTrabajo.ogg' ?>" type="audio/mp3" preload="preload">
            </audio>
            <button class="btn btn-primary text-center btnPersonalizado" onclick='reproducirAudioCargado("<?= $textoMostrar == "Inténtalo de nuevo" ? "idCambioAudioC" : "idBuenTrabajo" ?>", "iconoRepetir","fas fa-volume-off tamanoIcono","fas fa-volume-up tamanoIcono")'><em id="iconoRepetir" class="fas fa-volume-off tamanoIcono"></em></button>
            &nbsp;&nbsp;
            <label id="<?= $idLabel ?>" name="<?= $idLabel ?>" style="font-size: 25px;">
                <?= $textoMostrar ?>
            </label>
        </div>
        <br>
    </div>
<?php } ?>
<?php if ($habilitarBoton) { ?>
    <div id="<?= $idMensajes ?>" name="<?= $idMensajes ?>" style="display:none;">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', '<em class="' . $iconoFinal . '"></em>'), ['class' => 'btn btn-primary text-center estilo-Personalizado-B', 'onclick' => $funcionRepetir . '("' . $numeroTotal . '","' .  $TipoRespuestas . '")']) ?>
        </div>
    </div>
<?php } ?>