<?php

use yii\helpers\Html;

$this->title =  Yii::t('app', 'Crear usuarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', [
    'model' => $model,
    'errorMensaje' => $errorMensaje,
    'fechaActual' => $fechaActual,
    'parametro' => $parametro,
    'rolesLista' => $rolesLista,
    'institucionLista' => $institucionLista,
  ]) ?>

</div>