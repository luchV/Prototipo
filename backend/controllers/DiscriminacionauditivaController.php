<?php

namespace backend\controllers;

use Yii;
use common\helpers\ConsultasGenerales;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\helpers\ControlRoles;
use common\models\Modulos;
use common\models\RegistroActividad;
use common\models\Roles;
use DateTime;


/**
 * ConcienciaauditivaController implements the CRUD actions for Institucion model.
 */
class DiscriminacionauditivaController extends Controller
{
    private $modCodigo = '';

    /**
     * Si el usuario no ha iniciado sesión, solo puede acceder a la página de inicio de sesión. Si están
     * logueados, pueden acceder a todas las páginas
     * 
     * @return <code> = ControlRoles::Roles("7");
     */
    public function behaviors()
    {
        foreach (Modulos::listarModulosCodigoFiltro() as $key => $value) {
            if ($value == 'Discriminación auditiva') {
                $this->modCodigo = $key;
                break;
            }
        }
        $respuesta = ControlRoles::Roles("7");
        return [
            'verbs' => [
                'class' => AccessControl::class,
                'rules' => [
                    $respuesta
                ],
            ],
        ];
    }

    /**
     * > Esta función establece la zona horaria predeterminada en Guayaquil, Ecuador
     * 
     * @param action La acción a realizar.
     * 
     * @return El valor de retorno del método principal.
     */
    public function beforeAction($action)
    {
        date_default_timezone_set("America/Guayaquil");
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Una función que se llama cuando el usuario hace clic en un botón.
     * 
     * @return El regreso es una vista.
     */
    public function actionPregunta1()
    {
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        $rolTomado = Roles::BusquedaRol($rolUsuario);
        if ($rolTomado[0]['rolNombre'] == 'Profesor') {
            $usuCodigoSecc = Yii::$app->user->identity->usuCodigo;
        } else {
            $usuCodigoSecc = Yii::$app->user->identity->usuEncargado;
        }
        $seccionesUsuario = ConsultasGenerales::findModelSeccion($usuCodigoSecc, $this->modCodigo);

        if (count((array)$seccionesUsuario) == 0) {
            return $this->render('mensajeError', [
                'mensaje' => "No tiene actividades asignadas"
            ]);
        }

        foreach ($seccionesUsuario as  $value) {
            $modelSeccion = $value;
            break;
        }

        $modelModulo = ConsultasGenerales::findModel($modelSeccion->modCodigo);
        $modelRespuestas = ConsultasGenerales::findModelRespuestaTodos($modelSeccion->secCodigo);
        return ConsultasGenerales::renderPreguntas($this, $modelSeccion, $modelModulo, $modelRespuestas, $seccionesUsuario, 'totalErroresD', 'totalCorrectosD', 'FechaInicioD', 'moduloActivoD', 'seccionActivoD');
    }

    /**
     * Valida la respuesta, incrementa el contador correcto o incorrecto y devuelve la siguiente vista
     * 
     * @return El resultado del método actionPregunta2().
     */
    public function actionPregunta2()
    {
        try {
            if (isset($_POST['sinOrden']) && $_POST['sinOrden']) {
                $resultado =  ConsultasGenerales::vaidarCorrectoSinOrden('seccionActivoD');
            } else {
                $resultado = ConsultasGenerales::vaidarCorrecto('seccionActivoD');
            }
            if ($resultado->correctoV) {
                $_SESSION['totalCorrectosD'] = $_SESSION['totalCorrectosD']  + 1;
                $resultado->vista = ConsultasGenerales::obtenerVistaRender($this, $this->modCodigo);
            } else {
                $_SESSION['totalErroresD'] = $_SESSION['totalErroresD']  + 1;
            }
        } catch (\SoapFault $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (\Exception $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        }
        return $this->asJson($resultado);
    }

    /**
     * Valida la respuesta, incrementa el contador correcto o incorrecto y devuelve la siguiente vista
     * 
     * @return El resultado del método actionPregunta2().
     */
    public function actionPregunta3()
    {
        try {
            if (isset($_POST['sinOrden']) && $_POST['sinOrden']) {
                $resultado =  ConsultasGenerales::vaidarCorrectoSinOrden('seccionActivoD');
            } else {
                $resultado = ConsultasGenerales::vaidarCorrecto('seccionActivoD');
            }
            if ($resultado->correctoV) {
                $_SESSION['totalCorrectosD'] = $_SESSION['totalCorrectosD']  + 1;
                $resultado->vista = ConsultasGenerales::obtenerVistaRender($this, $this->modCodigo);
            } else {
                $_SESSION['totalErroresD'] = $_SESSION['totalErroresD']  + 1;
            }
        } catch (\SoapFault $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (\Exception $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        }
        return $this->asJson($resultado);
    }

    /**
     * Valida la respuesta, incrementa el contador correcto o incorrecto y devuelve la siguiente vista
     * 
     * @return El resultado del método actionPregunta2().
     */
    public function actionPregunta4()
    {
        try {
            if (isset($_POST['sinOrden']) && $_POST['sinOrden']) {
                $resultado =  ConsultasGenerales::vaidarCorrectoSinOrden('seccionActivoD');
            } else {
                $resultado = ConsultasGenerales::vaidarCorrecto('seccionActivoD');
            }
            if ($resultado->correctoV) {
                $_SESSION['totalCorrectosD'] = $_SESSION['totalCorrectosD']  + 1;
                $resultado->vista = ConsultasGenerales::obtenerVistaRender($this, $this->modCodigo);
            } else {
                $_SESSION['totalErroresD'] = $_SESSION['totalErroresD']  + 1;
            }
        } catch (\SoapFault $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (\Exception $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        }
        return $this->asJson($resultado);
    }


    /**
     * Valida la respuesta, incrementa el contador correcto o incorrecto y devuelve la siguiente vista
     * 
     * @return El resultado del método actionPregunta2().
     */
    public function actionPregunta5()
    {
        try {
            if (isset($_POST['sinOrden']) && $_POST['sinOrden']) {
                $resultado =  ConsultasGenerales::vaidarCorrectoSinOrden('seccionActivoD');
            } else {
                $resultado = ConsultasGenerales::vaidarCorrecto('seccionActivoD');
            }
            if ($resultado->correctoV) {
                $_SESSION['totalCorrectosD'] = $_SESSION['totalCorrectosD']  + 1;
                $resultado->vista = ConsultasGenerales::obtenerVistaRender($this, $this->modCodigo);
            } else {
                $_SESSION['totalErroresD'] = $_SESSION['totalErroresD']  + 1;
            }
        } catch (\SoapFault $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (\Exception $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        }
        return $this->asJson($resultado);
    }

    /**
     * Valida la respuesta, si es correcta agrega uno a la variable de sesión totalCorrectosD, si es
     * incorrecta agrega uno a la variable de sesión totalErroresD
     * 
     * @return El resultado de la acción.
     */
    public function actionPreguntaFinal()
    {
        try {
            if (isset($_POST['sinOrden']) && $_POST['sinOrden']) {
                $resultado =  ConsultasGenerales::vaidarCorrectoSinOrden('seccionActivoD');
            } else {
                $resultado = ConsultasGenerales::vaidarCorrecto('seccionActivoD');
            }

            if ($resultado->correctoV) {
                $_SESSION['totalCorrectosD'] = $_SESSION['totalCorrectosD']  + 1;
                $seccionesUsuario = ConsultasGenerales::findModelSeccionCodigo($_POST['codigoS']);
                $modelModulo = ConsultasGenerales::findModel($seccionesUsuario[0]->modCodigo);
                $resultado->vista = $this->renderAjax('preguntaFinal', [
                    'modelModulo' => $modelModulo,
                    'totalErrores' => $_SESSION['totalErroresD'],
                    'totalCorrecto' => $_SESSION['totalCorrectosD'],
                    'codigoS' => $_POST['codigoS'],
                ]);

                $fechaInicio = $_SESSION['FechaInicioD'];
                $fechaActual = new DateTime("now");
                $tiempoTrascurrido = $fechaInicio->diff($fechaActual);
                $tiempoTrascurrido = (($tiempoTrascurrido->days * 24) * 60) + ($tiempoTrascurrido->i * 60) + $tiempoTrascurrido->s;
                $registro = RegistroActividad::guardarRegistroActividad($_SESSION['totalCorrectosD'], $tiempoTrascurrido, $_SESSION['totalErroresD'], $_POST['codigoS'], $modelModulo->modCodigo);
                if ($registro->correcto) {
                    unset($_SESSION['totalCorrectosD']);
                    unset($_SESSION['totalErroresD']);
                    unset($_SESSION['FechaInicioD']);
                    unset($_SESSION['moduloActivoD']);
                    unset($_SESSION['seccionActivoD']);
                } else {
                    $resultado->correctoV = false;
                }
            } else {
                $_SESSION['totalErroresD'] = $_SESSION['totalErroresD']  + 1;
            }
        } catch (\SoapFault $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (\Exception $e) {
            $resultado->correctoV = false;
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        }
        return $this->asJson($resultado);
    }
}
