<?php

namespace backend\controllers;

use common\models\Seccionesmenu;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\helpers\ControlRoles;
use common\models\Params;
use MongoDB\Exception\Exception as ExceptionMongo;

/**
 * Site controller
 */
class SeccionesmenuController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $respuesta = ControlRoles::Roles("1");
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    


    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionPregunta1()
    {

        $Campos = Seccionesmenu::listarSecciones(Params::ins_codigo, "1");
        return $this->render('Menu1Seccion1', [
            'modelo' => $Campos[0],
            'controller' => "seccionesmenu",
            'accion' => "pregunta2",
        ]);
    }
    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionPregunta2($respuestas)
    {
        $resultado = new \stdClass;
        $resultado->transaccion = false;
        try {
            $Campos = Seccionesmenu::listarSecciones(Params::ins_codigo, "1");
            foreach ($Campos[0]["secc_respuestas"] as $opciones) {
                if (strcasecmp($respuestas, $opciones["text"]) == 0) {
                    if ($opciones["correcto"]) {
                        $resultado->transaccion = true;
                    }
                }
            }
            if ($resultado->transaccion) {
                $resultado->vista = $this->renderAjax('Menu1Seccion1', [
                    'modelo' => $Campos[1],
                    'controller' => "seccionesmenu",
                    'accion' => "pregunta3",
                ]);
                $resultado->errorDescripcion = "Las respuestas seleccionadas son correctas";
            } else {
                $resultado->errorDescripcion = "Las respuestas seleccionadas son incorrectas";
            }
        } catch (\SoapFault $e) {
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (ExceptionMongo $e) {
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        } catch (\Exception $e) {
            $resultado->errorDescripcion = $e->getMessage();
            $resultado->errorCodigo = $e->getCode();
            $resultado->errorLinea = $e->getLine();
        }
        return $this->asJson($resultado);
    }
}
