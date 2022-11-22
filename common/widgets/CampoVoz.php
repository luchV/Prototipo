<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class CampoVoz extends Widget
{

    /**
     * @var string
     */
    public $textoCampo1;

    /**
     * @var string
     */
    public $textoCampo2;

    /**
     * @var string
     */
    public $funcionVoz;

    /**
     * @var string
     */
    public $totalRespuestas;

    /**
     * @var string
     */
    public $funcionActiva;

    /**
     * @var string
     */
    public $ocultarCampoGeneral = '';

    /**
     * @var string
     */
    public $soloVoz = '';

    /**
     * @var string
     */
    public $vozActiva = '';

    /**
     * @var string
     */
    public $oculptarCampoMicro = '';

    /**
     * @var string
     */
    public $claseCheck = 'class="checkbox-JASoft"';

    /**
     * @var string
     */
    public $difetenteEstilo = 'class="conjunto-Microfono"';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('campoVoz', [
            'textoCampo1' => $this->textoCampo1,
            'textoCampo2' => $this->textoCampo2,
            'funcionVoz' => $this->funcionVoz,
            'totalRespuestas' => $this->totalRespuestas,
            'ocultarCampoGeneral' => $this->ocultarCampoGeneral,
            'oculptarCampoMicro' => $this->oculptarCampoMicro,
            'funcionActiva' => $this->funcionActiva,
            'soloVoz' => $this->soloVoz,
            'vozActiva' => $this->vozActiva,
            'claseCheck' => $this->claseCheck,
            'difetenteEstilo' => $this->difetenteEstilo,
        ]);
    }
}
