<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class PreguntaFinal extends Widget
{

    /**
     * @var string
     */
    public $TextoTitulo;

    /**
     * @var string
     */
    public $iconoTitulo;

    /**
     * @var string
     */
    public $primerCampo = '';

    /**
     * @var string
     */
    public $textoPrimerCampo = '';

    /**
     * @var string
     */
    public $segundoCampo = '';

    /**
     * @var string
     */
    public $textoSegundoCampo = '';

    /**
     * @var string
     */
    public $tercerCampo = '';

    /**
     * @var string
     */
    public $textoTercerCampo = '';

    /**
     * @var string
     */
    public $redireccion;

    /**
     * @var string
     */
    public $textoBoton;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('preguntaFinal', [
            'TextoTitulo' => $this->TextoTitulo,
            'iconoTitulo' => $this->iconoTitulo,
            'primerCampo' => $this->primerCampo,
            'textoPrimerCampo' => $this->textoPrimerCampo,
            'segundoCampo' => $this->segundoCampo,
            'textoSegundoCampo' => $this->textoSegundoCampo,
            'tercerCampo' => $this->tercerCampo,
            'textoTercerCampo' => $this->textoTercerCampo,
            'redireccion' => $this->redireccion,
            'textoBoton' => $this->textoBoton,
        ]);
    }
}
