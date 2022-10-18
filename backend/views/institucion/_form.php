<?php

use common\helpers\FuncionesGenerales;
use yii\bootstrap4\ActiveForm;
use common\widgets\GuardarCambios;
?>


<?php $form = ActiveForm::begin(); ?>
<div class="institucion-form">

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'insNombre') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'ubicación') ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'insEstado')->dropDownList(FuncionesGenerales::TiposEstados(), array(
                'name' => 'insEstado',
                'id' => 'insEstado',
                'style' => 'float:left;width:200px;',
            )); ?>
        </div>
    </div>
    <hr>
    <?php if ($errorMensaje != '') { ?>
        <div class="alert alert-danger" role="alert"><?= $errorMensaje ?></div>
    <?php } ?>
    <?= GuardarCambios::widget([
        'model' => $model,
    ]); ?>
</div>
<?php ActiveForm::end(); ?>