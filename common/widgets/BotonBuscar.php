<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class BotonBuscar extends Widget
{
    /**
     * @var string
     */
    public $textoBusqueda;
    /**
     * @var string
     */
    public $textoBoton;
    /**
     * @var string
     */
    public $idInput;
    /**
     * @var string
     */
    public $nameButton;
    /**
     * @var string
     */
    public $longitudMaximaInput;
    /**
     * @var string
     */
    public $longitudMinimaInput;
    /**
     * @var string
     */
    public $valorInput;
    /**
     * @var string
     */
    public $nameInput;
    /**
     * @var string
     */
    public $camposExtras = "";
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('botonBuscar', [
            'textoBusqueda' => $this->textoBusqueda,
            'textoBoton' => $this->textoBoton,
            'idInput' => $this->idInput,
            'nameInput' => $this->nameInput,
            'nameButton' => $this->nameButton,
            'longitudMaximaInput' => $this->longitudMaximaInput,
            'longitudMinimaInput' => $this->longitudMinimaInput,
            'valorInput' => $this->valorInput,
            'camposExtras' => $this->camposExtras,
        ]);
    }
}
