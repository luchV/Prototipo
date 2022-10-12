<?php

use yii\helpers\Html;
?>

<div class="col-md-3 col-4 ml-auto">
  <?= Html::a(Yii::t('app', $iconoBoton. ' ' . $textoBoton), [$accionRealizar], [
    'class' => 'btn btn-primary btn-block py-2'
  ]) ?>
</div>