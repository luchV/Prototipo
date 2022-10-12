<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */

$this->title = Yii::t('app',  Yii::t('app', 'Actualizar: '), [
    'modelClass' => 'Menus',
]) . ' ' . $model->men_nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->men_nombre, 'url' => ['update', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] =  Yii::t('app', 'Update');
?>
<div class="Menus-update">
    <div class="name-tag">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>