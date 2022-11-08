<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class IntentaloNuevamente extends Widget
{
    /**
     * @var string
     */
    public $funcionRepetir;
    /**
     * @var string
     */
    public $numeroTotal;
    /**
     * @var string
     */
    public $TipoRespuestas;

    public function run()
    {
        return $this->render('intentaloNuevamente', [
            'funcionRepetir' => $this->funcionRepetir,
            'numeroTotal' => $this->numeroTotal,
            'TipoRespuestas' => $this->TipoRespuestas,
        ]);
    }
}
