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
    /**
     * @var string
     */
    public $textoMostrar = 'Inténtalo de nuevo';
    /**
     * @var string
     */
    public $iconoMostrar = 'fas fa-undo-alt fa-3x';
    /**
     * @var string
     */
    public $textoBoton = '';
    /**
     * @var string
     */
    public $idMensajes = 'MensajeRespuesta';

    /**
     * @var string
     */
    public $idLabel = 'intentaloNuevo';

    public function run()
    {
        return $this->render('intentaloNuevamente', [
            'funcionRepetir' => $this->funcionRepetir,
            'numeroTotal' => $this->numeroTotal,
            'TipoRespuestas' => $this->TipoRespuestas,
            'textoMostrar' => $this->textoMostrar,
            'iconoMostrar' => $this->iconoMostrar,
            'textoBoton' => $this->textoBoton,
            'idMensajes' => $this->idMensajes,
            'idLabel' => $this->idLabel,
        ]);
    }
}
