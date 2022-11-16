<?php

use yii\bootstrap4\Html;

?>

<div id="btn_next" <?= $estiloBoton ?>>
    <br>
    <div class="form-group" style="text-align: end !important;">
        <?= Html::submitButton(Yii::t('app', $textoBotton == 'Siguiente' ? '<em class="fas fa-arrow-right"></em>' : '<em class="fas fa-flag-checkered"></em>'), ['class' => 'btn btn-primary text-center estilo-Personalizado-B', 'title' => 'Siguiente', 'onclick' => $funcionSiguiente . '("' . $controllador . '","' . $accion . '","' . $secTipoRespuesta . '","solo")']) ?>
    </div>
</div>