<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class BotonesCRC extends Widget
{

    /**
     * @var string
     */
    public $funcionRepetir;

    /**
     * @var string
     */
    public $funcionContinuar;

    /**
     * @var string
     */
    public $totalFotos;

    /**
     * @var string
     */
    public $totalFotosSegundo;

    /**
     * @var string
     */
    public $secTipoRespuesta;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('botonesCRC', [
            'funcionRepetir' => $this->funcionRepetir,
            'funcionContinuar' => $this->funcionContinuar,
            'totalFotos' => $this->totalFotos,
            'totalFotosSegundo' => $this->totalFotosSegundo,
            'secTipoRespuesta' => $this->secTipoRespuesta,
        ]);
    }
}
