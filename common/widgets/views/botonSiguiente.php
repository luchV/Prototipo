<?php

use yii\bootstrap4\Html;

?>

<div class="col-md-12" id="btn_next" <?= $estiloBoton ?>>
    <br>
    <div class="form-group" style="text-align: end !important;">
        <?= Html::submitButton(Yii::t('app', $textoBotton . ' <em class="fas fa-arrow-right"></em>'), ['class' => 'btn btn-primary text-center', 'onclick' => $funcionSiguiente . '("' . $controllador . '","' . $accion . '","' . $secTipoRespuesta . '","solo")']) ?>
    </div>
</div>