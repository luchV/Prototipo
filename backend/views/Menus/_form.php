<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */
/* @var $form yii\bootstrap4\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="banners-form">

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'men_nombre') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'men_icono') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'men_url') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'men_ordena') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_Padre') ?>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group" style="text-align: center;">
            <?= Html::submitButton(
                Yii::t('app', '<em class="fa fa-save"></em> Guardar')
            ); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>