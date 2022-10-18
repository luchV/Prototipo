<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class TelefonoModal extends Widget
{
  /**
   * @var[]
   */
  public $modelTelefono;
  
  /**
   * {@inheritdoc}
   */
  public function run()
  {
    return $this->render('telefonoModal', ['modelTelefono' => $this->modelTelefono]);
  }
}
