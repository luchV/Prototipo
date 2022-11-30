<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'blank';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            $usuarioCorrecto = User::findByUsername($model->username, $model->institucion);
            if (!is_null($usuarioCorrecto)) {
                $usuario = new User();
                $usuario->contrasena = $usuarioCorrecto->contrasena;
                $validarContra = $usuario->validatePassword($model->password);
                if ($validarContra) {
                    $encargado = User::BusquedaUsuario($usuarioCorrecto->usuEncargado);
                    if (count($encargado) > 0) {
                        if ($model->login()) {
                            return $this->goBack();
                        }
                    } else {
                        $error = "El usuario no tiene un encargado, </br> por favor comuníquese con un administrador.";
                    }
                } else {
                    $error = "La contraseña está incorrecta.";
                }
            } else {
                $error = "El correo está incorrecto.";
            }
        }
        return $this->render('login', [
            'model' => $model,
            'mensajeError' => $error ?? "",
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
