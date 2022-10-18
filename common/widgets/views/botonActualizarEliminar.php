<?php

use yii\helpers\Html;
?>

<div class="d-flex">
    <?php if ($editarBoton) { ?>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $idBoton], ['class' => 'btn btn-primary']) ?>
    <?php } ?>

    <?php if ($eliminarBoton) { ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $idBoton], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app',  Yii::t('app', 'Está seguro que desea eliminar: ' . $mensajeEliminar)),
                'method' => 'post',
            ],
        ]) ?>
    <?php } ?>
</div>