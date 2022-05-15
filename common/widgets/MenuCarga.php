<?php

namespace common\widgets;

use Yii;
use yii\bootstrap4\Widget;

class MenuCarga extends Widget
{

  /**
   * {@inheritdoc}
   */
  public function run()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->render('menuCarga', [
        'actualUrl' => Yii::$app->getRequest()->getUrl(),
      ]);
    }
    return '';
  }
}
