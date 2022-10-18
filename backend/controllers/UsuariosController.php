<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\search\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\helpers\ControlRoles;
use common\models\Institucion;
use common\models\Params;
use common\models\Roles;
use common\models\telefonousuario;
use common\widgets\TelefonoModal;
use Exception;

/**
 * BannersController implements the CRUD actions for User model.
 */
class UsuariosController extends Controller
{
    public function behaviors()
    {
        $respuesta = ControlRoles::Roles("2");
        return [
            'verbs' => [
                'class' => AccessControl::class,
                'rules' => [
                    $respuesta
                ],
            ],
        ];
    }

    //PARA CONSUMIR WEBSERVICES
    public function beforeAction($action)
    {
        date_default_timezone_set("America/Guayaquil");
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        $insUsuario = Yii::$app->user->identity->insCodigo;
        $rolTomado = Roles::BusquedaRol($rolUsuario);
        $busqueda = new UsuariosSearch();
        switch ($rolTomado[0]['rolNumero']) {
            case '3':
                $busqueda->insCodigo = Yii::$app->user->identity->insCodigo;
                break;
            case '4':
                $busqueda->usuEncargado = Yii::$app->user->identity->usuEncargado;
                break;
        }

        $dataProvider = $busqueda->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider,
            'institucionLista' => Institucion::detectarInstituciones($rolUsuario, $insUsuario),
            'rolActivo' => $rolTomado[0]['rolNumero'],
        ]);
    }


    /**
     * Displays a single Banners model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'registro';
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        $insUsuario = Yii::$app->user->identity->insCodigo;
        $modelTelefono = [];

        if ($model->load(Yii::$app->request->post())) {
            $model->usuCodigo = bin2hex(openssl_random_pseudo_bytes(20));
            $model->contrasena = hash('sha512', $_POST['User']['contrasena']);
            if ($_POST['User']['rolCodigo'] == Roles::indiceRol(Roles::listarRoles(), "Super Administrador")) {
                $model->usuEncargado = $model->usuCodigo;
            }
            try {
                if ($model->save()) {
                    if (isset($_POST['tablaDatos'])) {
                        $datos = $_POST['tablaDatos'];
                        foreach ($datos as $dato) {
                            $modelTelefono = new telefonousuario();
                            $modelTelefono->usuCodigo = $model->usuCodigo;
                            $modelTelefono->NumeroTelf = $dato;
                            $modelTelefono->save();
                        }
                    }
                    return $this->redirect(['index']);
                } else {
                    $error = 'Se produjo un error al momento de realizar la acción ';
                }
            } catch (Exception $e) {
                $error = 'Validar que la cédula o correo no pertenezcan a otro usuario.';
            }

            $model->contrasena = $_POST['User']['contrasena'];
            if (isset($_POST['tablaDatos'])) {
                $modelTelefono = $_POST['tablaDatos'];
            }
        }
        Yii::$app->view->params['modalTelefono'] = TelefonoModal::widget(['modelTelefono' => $modelTelefono]);

        return $this->render('create', [
            'model' => $model,
            'errorMensaje' => $error ?? '',
            'fechaActual' => date("Y-m-d"),
            'parametro' => substr(Roles::indiceRol(Roles::listarRoles(), "Super Administrador"), 0, 10),
            'rolesLista' => Roles::detectarRoles($rolUsuario),
            'institucionLista' => Institucion::detectarInstituciones($rolUsuario, $insUsuario),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelTelefono = telefonousuario::BusquedaTelefono($id);
        $model->scenario = 'registro';
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        $insUsuario = Yii::$app->user->identity->insCodigo;

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['tablaDatos'])) {
                if (isset($_POST['activarContrasena'])) {
                    $model->contrasena = hash('sha512', $_POST['User']['contrasena']);
                    $botonActivado = "checked";
                }

                if ($_POST['User']['rolCodigo'] == Roles::indiceRol(Roles::listarRoles(), "Super Administrador")) {
                    $model->usuEncargado = $model->usuCodigo;
                }
                try {
                    if ($model->save()) {
                        $modelTelefonoEliminar = telefonousuario::BusquedaTelefonoModelo($id);
                        foreach ($modelTelefonoEliminar as $value) {
                            $value->delete();
                        }
                        if (isset($_POST['tablaDatos'])) {
                            $datos = $_POST['tablaDatos'];
                            foreach ($datos as $dato) {
                                $modelTelefono = new telefonousuario();
                                $modelTelefono->usuCodigo = $model->usuCodigo;
                                $modelTelefono->NumeroTelf = $dato;
                                $modelTelefono->save();
                            }
                        }
                        return $this->redirect(['index']);
                    } else {
                        $error = 'Se produjo un error al momento de realizar la acción.';
                    }
                } catch (Exception $e) {
                    $error = 'Validar que la cédula o correo no pertenezcan a otro usuario.';
                }
                $model->contrasena = $_POST['User']['contrasena'];
            }
            if (isset($_POST['tablaDatos'])) {
                $modelTelefono = $_POST['tablaDatos'];
            } else {
                $modelTelefono = [];
                $error = 'Por favor ingresar un número de teléfono para el usuario.';
            }
        }
        Yii::$app->view->params['modalTelefono'] = TelefonoModal::widget(['modelTelefono' => $modelTelefono]);

        return $this->render('update', [
            'model' => $model,
            'errorMensaje' => $error ?? '',
            'fechaActual' => date("Y-m-d"),
            'parametro' => substr(Roles::indiceRol(Roles::listarRoles(), "Super Administrador"), 0, 10),
            'rolesLista' => Roles::detectarRoles(Yii::$app->user->identity->rolCodigo),
            'institucionLista' => Institucion::detectarInstituciones($rolUsuario, $insUsuario),
            'editar' => true,
            'activado' => $botonActivado ?? '',
            'rolActivo' => Roles::BusquedaRol($rolUsuario)
        ]);
    }

    /**
     * Finds the Banners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Banners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $model->estado = Params::ESTADOINACTIVO;
        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBuscarUsuarios($idInstitucion)
    {
        return  json_encode(User::listarUsuarios($idInstitucion));
    }
}
