<?php

namespace common\helpers;

use backend\models\search\ModulosSearch;
use backend\models\search\SeccionesSearch;
use common\models\Params;
use common\models\Respuestas;
use DateTime;
use yii\web\NotFoundHttpException;

class ConsultasGenerales
{

    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return ModulosSearch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    static function findModel($id)
    {
        if (($model = ModulosSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return SeccionesModulos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    static function findModelSeccion($id, $modCodigo)
    {
        if (($model = SeccionesSearch::find()->where(['usuCodigo' => $id, 'modCodigo' => $modCodigo, 'secEstado' => Params::ESTADOOK])->orderBy('secNumeroPregunta')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return SeccionesSearch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    static function findModelSeccionCodigo($id)
    {
        if (($model = SeccionesSearch::find()->where(['secCodigo' => $id, 'secEstado' => Params::ESTADOOK])->orderBy('secNumeroPregunta')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Respuestas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    static function findModelRespuestaTodos($id)
    {
        if (($model = Respuestas::find()->where(['secCodigo' => $id])->orderBy('resNumero')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Respuestas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    static function findModelRespuestaConteoR($id)
    {
        if (($model = Respuestas::find()->where(['secCodigo' => $id, 'respuestaCorrecto' => 'true'])->orderBy('resNumero')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Respuestas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    static function findModelRespuestaConteoEspecial($id)
    {
        if (($model = Respuestas::find()->where(['secCodigo' => $id, 'respuestaCorrectoEspecial' => 'true'])->orderBy('resNumero')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Representa una vista basada en el valor de una variable.
     * 
     * @param modelSeccion es la sección de la actividad
     * @param modelModulo es el modelo del modulo
     * @param modelRespuestas es una matriz de objetos del tipo Respuestas
     * @param seccionesUsuario es una matriz de objetos que contiene las secciones del módulo que el
     * usuario tiene que hacer.
     * 
     * @return La función de representación devuelve una cadena.
     */
    static function renderPreguntas($render, $modelSeccion, $modelModulo, $modelRespuestas, $seccionesUsuario, $totalErrores, $totalCorrectos, $fechaInicio)
    {
        switch ($modelSeccion->secNumeroPregunta) {
            case '1':
                $pregunta = 'pregunta1';
                break;
            case '2':
                $pregunta = 'pregunta2';
                break;
            case '3':
                $pregunta = 'pregunta3';
                break;
            case '4':
                $pregunta = 'pregunta4';
                break;
            case '5':
                $pregunta = 'pregunta5';
                break;
            default:
                $pregunta = 'mensajeError';
                return $render->render('mensajeError', [
                    'mensaje' => "No existe la actividad asignada"
                ]);
                break;
        }
        $_SESSION[$totalErrores] = $_SESSION[$totalErrores] ?? 0;
        $_SESSION[$totalCorrectos] = $_SESSION[$totalCorrectos] ??  0;
        $_SESSION[$fechaInicio] = $_SESSION[$fechaInicio] ?? new DateTime("now");

        return $render->render($pregunta, [
            'modelSeccion' => $modelSeccion,
            'modelModulo' => $modelModulo,
            'modelRespuestas' => $modelRespuestas,
            'accion' => "pregunta" . ($seccionesUsuario[1]->secNumeroPregunta ?? '-final'),
        ]);
    }

    /**
     * Devuelve una vista con la siguiente pregunta y las respuestas a esa pregunta.
     * </código>
     * 
     * @return Se está devolviendo la vista.
     */
    static function obtenerVistaRender($render, $modCodigo)
    {
        $seccionesUsuario = self::findModelSeccionCodigo($_POST['codigoS']);
        $seccionesModulo = self::findModelSeccion($seccionesUsuario[0]->usuCodigo, $modCodigo);
        $siguienteS = '';
        $siguientesButton = '';

        foreach ($seccionesModulo as $opciones) {
            if ($siguientesButton != '') {
                $siguientesButton = '';
                $siguienteModelButton = $opciones;
            }
            if ($siguienteS != '') {
                $siguienteS = '';
                $siguientesButton = 'siguiente';
                $siguienteModel = $opciones;
            }
            if ($opciones->secCodigo == $_POST['codigoS']) {
                $siguienteS = 'siguiente';
            }
        }

        $modelModulo = self::findModel($seccionesUsuario[0]->modCodigo);
        $modelRespuestas = self::findModelRespuestaTodos($siguienteModel->secCodigo);
        return $render->renderAjax('pregunta' . $siguienteModel['secNumeroPregunta'], [
            'modelSeccion' =>  $siguienteModel,
            'modelModulo' => $modelModulo,
            'modelRespuestas' => $modelRespuestas,
            'accion' => "pregunta" . ($siguienteModelButton->secNumeroPregunta ?? '-final'),
        ]);
    }

    /**
     * Toma una matriz de cadenas y compara cada cadena con una cadena en una base de datos. Si todas
     * las cadenas coinciden, devuelve verdadero. Si alguna de las cadenas no coincide, devuelve falso.
     * 
     * @return El resultado de la función es un objeto stdClass.
     */
    static function vaidarCorrecto()
    {
        $resultado = new \stdClass;
        $resultado->correctoV = false;
        $seccionesUsuario = self::findModelRespuestaConteoR($_POST['codigoS']);
        $repuestas = $_POST['respuestas'];
        $repuestas = array_filter($repuestas, "strlen");
        $contador = 0;
        if (count($repuestas) == count((array)$seccionesUsuario)) {
            foreach ($repuestas as $opciones) {
                if (strcasecmp($opciones, $seccionesUsuario[$contador]->respuestaTexto) == 0) {
                    $resultado->correctoV = true;
                    $contador++;
                } else {
                    $resultado->correctoV = false;
                    break;
                }
            }
        }
        return $resultado;
    }

    /**
     * Toma una matriz de cadenas y compara cada cadena con una cadena en una base de datos. Si todas
     * las cadenas coinciden, devuelve verdadero. Si alguna de las cadenas no coincide, devuelve falso.
     * 
     * @return El resultado de la función es un objeto stdClass.
     */
    static function vaidarCorrectoSinOrden()
    {
        $resultado = new \stdClass;
        $resultado->correctoV = true;
        $seccionesUsuario = self::findModelRespuestaConteoR($_POST['codigoS']);
        $repuestas = $_POST['respuestas'];
        $repuestas = array_filter($repuestas, "strlen");
        $auxiliar = false;
        if (count($repuestas) == count((array)$seccionesUsuario)) {
            foreach ($repuestas as $opciones) {
                foreach ($seccionesUsuario as $opciones2) {
                    if (strcasecmp($opciones, $opciones2->respuestaTexto) == 0) {
                        if ($opciones2->respuestaTexto) {
                            $auxiliar = true;
                        }
                    }
                }
                if (!$auxiliar) {
                    $resultado->correctoV = false;
                    break;
                } else {
                    $auxiliar = false;
                }
            }
        } else {
            $resultado->correctoV = false;
        }
        return $resultado;
    }

    /**
     * Toma una matriz de cadenas y compara cada cadena con una cadena en una base de datos. Si todas
     * las cadenas coinciden, devuelve verdadero. Si alguna de las cadenas no coincide, devuelve falso.
     * 
     * @return El resultado de la función es un objeto stdClass.
     */
    static function vaidarCorrectoSinOrdenEspecial()
    {
        $resultado = new \stdClass;
        $resultado->correctoV = true;
        $seccionesUsuario = self::findModelRespuestaConteoEspecial($_POST['codigoS']);
        $repuestas = $_POST['respuestas'];
        $repuestas = array_filter($repuestas, "strlen");
        $resultado->totalRespuestas = count((array)$seccionesUsuario);
        $auxiliar = false;
        if (count($repuestas) == count((array)$seccionesUsuario)) {
            foreach ($repuestas as $opciones) {
                foreach ($seccionesUsuario as $opciones2) {
                    if (strcasecmp($opciones, $opciones2->respuestaTexto) == 0) {
                        if ($opciones2->respuestaTexto) {
                            $auxiliar = true;
                        }
                    }
                }
                if (!$auxiliar) {
                    $resultado->correctoV = false;
                    break;
                } else {
                    $auxiliar = false;
                }
            }
        } else {
            $resultado->correctoV = false;
        }

        return $resultado;
    }
}
