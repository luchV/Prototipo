<?php

namespace common\widgets;

use yii\bootstrap4\Widget;

class BotonActualizarEliminar extends Widget
{
    /**
     * @var string
     */
    public $editarBoton = false;

    /**
     * @var string
     */
    public $desactivarBoton = false;
    /**
     * @var string
     */
    public $accionDesactivar = '';
    /**
     * @var string
     */
    public $mensajeMuestraDesactivar = '';
    /**
     * @var string
     */
    public $controller = '';
    /**
     * @var string
     */
    public $eliminarBoton = false;
    /**
     * @var string
     */
    public $accionEliminar = '';
        /**
     * @var string
     */
    public $mensajeMuestraEliminar = '';
    /**
     * @var string
     */
    public $idBoton = '';
    /**
     * @var string
     */
    public $mensajeNombre = '';
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('botonActualizarEliminar', [
            'editarBoton' => $this->editarBoton,
            'desactivarBoton' => $this->desactivarBoton,
            'accionDesactivar' => $this->accionDesactivar,
            'mensajeMuestraDesactivar' => $this->mensajeMuestraDesactivar,
            'eliminarBoton' => $this->eliminarBoton,
            'accionEliminar' => $this->accionEliminar,
            'mensajeMuestraEliminar' => $this->mensajeMuestraEliminar,
            'idBoton' => $this->idBoton,
            'mensajeNombre' => $this->mensajeNombre,
            'controller' => $this->controller,
        ]);
    }
}
