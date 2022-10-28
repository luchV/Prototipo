<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class CalendarioBusqueda extends Widget
{

  /**
   * @var string
   */
  public $fechaSeleccionada = '';

  /**
   * @var string
   */
  public $idFecha = '';

  /**
   * @var string
   */
  public $nameFecha = '';

  /**
   * {@inheritdoc}
   */
  public function run()
  {
    return $this->render('calendarioBusqueda', [
      'fechaSeleccionada' => $this->fechaSeleccionada,
      'idFecha' => $this->idFecha,
      'nameFecha' => $this->nameFecha,
    ]);
  }
}
