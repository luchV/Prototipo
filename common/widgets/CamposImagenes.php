<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class CamposImagenes extends Widget
{

    /**
     * @var string
     */
    public $modelRespuestas;

    /**
     * @var string
     */
    public $totalRespuestas;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('camposImagenes', [
            'modelRespuestas' => $this->modelRespuestas,
            'totalRespuestas' => $this->totalRespuestas,
        ]);
    }
}
