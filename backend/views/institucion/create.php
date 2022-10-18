<?php

use yii\helpers\Html;

$this->title =  Yii::t('app', 'Crear instituciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instituciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institucion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'errorMensaje' => $errorMensaje
    ]) ?>

</div>