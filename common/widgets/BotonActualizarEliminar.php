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
    public $eliminarBoton = false;
    /**
     * @var string
     */
    public $idBoton = '';
    /**
     * @var string
     */
    public $mensajeEliminar = '';
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('botonActualizarEliminar', [
            'editarBoton' => $this->editarBoton,
            'eliminarBoton' => $this->eliminarBoton,
            'idBoton' => $this->idBoton,
            'mensajeEliminar' => $this->mensajeEliminar,
        ]);
    }
}
