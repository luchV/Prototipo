<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class BotonAgregar extends Widget
{
  /**
   * @var string
   */
  public $textoBoton = '';

  /**
   * @var string
   */
  public $accionRealizar = '';
  /**
   * @var string
   */
  public $iconoBoton = '';
  /**
   * {@inheritdoc}
   */
  public function run()
  {
    return $this->render('botonAgregar', [
      'textoBoton' => $this->textoBoton,
      'accionRealizar' => $this->accionRealizar,
      'iconoBoton' => $this->iconoBoton,
    ]);
  }
}
