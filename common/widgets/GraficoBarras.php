<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class GraficoBarras extends Widget
{
    /**
     * @var string
     */
    public $editarBoton = false;

    /**
     * @var string
     */
    public $chartSale;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('graficoBarras', [
            'chartSale' => $this->chartSale,
        ]);
    }
}
