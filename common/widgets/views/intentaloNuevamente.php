<?php

use yii\bootstrap4\Html;

?>

<div id="MensajeRespuesta" name="MensajeRespuesta" style="display:none;">
    <div class="col-md-12" style="text-align: center;">
        <button class="btnPersonalizado" onclick='reproducir("Intentalo de nuevo", "iconoRepetir","fas fa-volume-off","fas fa-volume-up")'><em id="iconoRepetir" class="fas fa-volume-off"></em></button>
        <label id="intentaloNuevo" name="intentaloNuevo">
            Inténtalo de nuevo
        </label>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '<em class="fas fa-undo-alt fa-3x"></em>'), ['class' => 'btn btn-primary text-center', 'onclick' => $funcionRepetir . '("' . $numeroTotal . '","' .  $TipoRespuestas . '")']) ?>
    </div>
</div>