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

<div id="<?= $idMensajes ?>" name="<?= $idMensajes ?>" style="display:none;">
    <div class="col-md-12" style="text-align: center;">
        <button class="btn btn-primary text-center btnPersonalizado" onclick='reproducir("<?= $textoMostrar ?>", "iconoRepetir","fas fa-volume-off tamanoIcono","fas fa-volume-up tamanoIcono")'><em id="iconoRepetir" class="fas fa-volume-off tamanoIcono"></em></button>
        &nbsp;&nbsp;
        <label id="<?= $idLabel ?>" name="<?= $idLabel ?>" style="font-size: 23px;">
            <?= $textoMostrar ?>
        </label>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '<em class="' . $iconoFinal . '"></em>'), ['class' => 'btn btn-primary text-center estilo-Personalizado-B', 'onclick' => $funcionRepetir . '("' . $numeroTotal . '","' .  $TipoRespuestas . '")']) ?>
    </div>
</div>