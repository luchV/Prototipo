<?php

namespace backend\controllers;

use common\models\Seccionesmenu;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\helpers\ControlRoles;
use common\models\Params;

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

        $Campos=Seccionesmenu::listarSecciones(Params::ins_codigo, "1");
        return $this->render('Menu1Seccion1', [
            'modelo' => $Campos[0],
        ]);
    }
}
