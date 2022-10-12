<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\Utils;
use common\models\Parametros;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */

$this->title = $model->men_nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Menus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'men_nombre',
        ],
    ]) ?>

</div>