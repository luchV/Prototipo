<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class ContenedorTablas extends Widget
{

  /**
   * {@inheritdoc}
   */
  public function init()
  {
    parent::init();
    ob_start();
  }

  /**
   * {@inheritdoc}
   */
  public function run()
  {
    $contentTabla = ob_get_clean();
    return $this->render('contenedorTablas', [
      'contentTabla' => $contentTabla,
    ]);
  }
}
