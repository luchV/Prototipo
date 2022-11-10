<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class CampoAudio extends Widget
{

    /**
     * @var string
     */
    public $idDivGeneral;

    /**
     * @var string
     */
    public $audioCargado;

    /**
     * @var string
     */
    public $idAudio;

    /**
     * @var string
     */
    public $idIconoButton;

    /**
     * @var string
     */
    public $idLabel;

    /**
     * @var string
     */
    public $textoCampo;

    /**
     * @var string
     */
    public $ocultarCampo = '';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('campoAudio', [
            'idDivGeneral' => $this->idDivGeneral,
            'audioCargado' => $this->audioCargado,
            'ocultarCampo' => $this->ocultarCampo,
            'idAudio' => $this->idAudio,
            'idIconoButton' => $this->idIconoButton,
            'idLabel' => $this->idLabel,
            'textoCampo' => $this->textoCampo,
        ]);
    }
}
