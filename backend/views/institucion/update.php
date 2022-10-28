<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app',  'Actualizar: ', [
    'modelClass' => 'Institucion',
]) . ' ' . $model->insNombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instituciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->insNombre, 'url' => ['view', 'id' => (string)$model->insCodigo]];
$this->params['breadcrumbs'][] =  Yii::t('app', 'Actualizar');
?>
<div class="institucion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'errorMensaje' =>$errorMensaje
    ]) ?>

</div>