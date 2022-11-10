<?php

use yii\bootstrap4\Html;

?>

<div id="<?= $idMensajes ?>" name="<?= $idMensajes ?>" style="display:none;">
    <div class="col-md-12" style="text-align: center;">
        <button class="btnPersonalizado" onclick='reproducir("<?= $textoMostrar ?>", "iconoRepetir","fas fa-volume-off tamanoIcono","fas fa-volume-up tamanoIcono")'><em id="iconoRepetir" class="fas fa-volume-off tamanoIcono"></em></button>
        &nbsp;&nbsp;
        <label id="<?= $idLabel ?>" name="<?= $idLabel ?>" style="font-size: 23px;">
            <?= $textoMostrar ?>
        </label>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton($textoBoton . Yii::t('app', '<em class="' . $iconoMostrar . '"></em>'), ['class' => 'btn btn-primary text-center', 'onclick' => $funcionRepetir . '("' . $numeroTotal . '","' .  $TipoRespuestas . '")']) ?>
    </div>
</div>