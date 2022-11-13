<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class UsuariosModal extends Widget
{
  /**
   * @var UsuariosSearch
   */
  public $modalUsuario;

  /**
   * @var search
   */
  public $dataProvider;

  /**
   * @var string
   */
  public $rolActivo;

  /**
   * @var string
   */
  public $Texto;

  /**
   * @var string
   */
  public $estudiante = true;

  /**
   * {@inheritdoc}
   */
  public function run()
  {
    return $this->render(
      'usuariosModal',
      [
        'modalUsuario' => $this->modalUsuario,
        'dataProvider' => $this->dataProvider,
        'rolActivo' => $this->rolActivo,
        'Texto' => $this->Texto,
        'estudiante' => $this->estudiante,
      ]
    );
  }
}
