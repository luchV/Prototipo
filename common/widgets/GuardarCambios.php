<?php


namespace common\widgets;

use Yii;
use yii\bootstrap4\Widget;
use yii\helpers\Html;

class GuardarCambios extends Widget
{

  /**
   * @var \yii\bd\ActiveRecord
   */
  public $model;

  /**
   * {@inheritdoc}
   */
  public function run()
  {
    return '<div class="col-md-12 mt-3">
    <div class="form-group" style="text-align: center;">'
      . Html::submitButton(
        Yii::t('app', '<em class="fa fa-save"></em> Guardar'),
        array_merge([
          'class' => 'btn btn-primary text-center'
        ])
      ) . ' </div> </div>';
  }
}
