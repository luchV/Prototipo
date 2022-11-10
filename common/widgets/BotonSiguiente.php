<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class BotonSiguiente extends Widget
{

    /**
     * @var string
     */
    public $textoBotton;

    /**
     * @var string
     */
    public $funcionSiguiente;

    /**
     * @var string
     */
    public $controllador;

    /**
     * @var string
     */
    public $accion;

    /**
     * @var string
     */
    public $secTipoRespuesta;

    /**
     * @var string
     */
    public $estiloBoton = 'style="display:none;"';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('botonSiguiente', [
            'textoBotton' => $this->textoBotton,
            'funcionSiguiente' => $this->funcionSiguiente,
            'controllador' => $this->controllador,
            'accion' => $this->accion,
            'secTipoRespuesta' => $this->secTipoRespuesta,
            'estiloBoton' => $this->estiloBoton,
        ]);
    }
}
