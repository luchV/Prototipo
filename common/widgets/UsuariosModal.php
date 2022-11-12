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
      ]
    );
  }
}
