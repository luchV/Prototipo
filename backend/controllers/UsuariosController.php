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
use common\models\RelacionModulos;
use common\models\Roles;
use common\models\telefonousuario;
use common\models\TieneModulosUsuarios;
use common\widgets\TelefonoModal;
use Exception;

/**
 * UsuariosController implements the CRUD actions for User model.
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
        $parametros = Yii::$app->request->queryParams;
        $rolTomado = Roles::BusquedaRol($rolUsuario);
        $busqueda = new UsuariosSearch();
        switch ($rolTomado[0]['rolNumero']) {
            case '2':
                $dataProvider = $busqueda->search($parametros);
                break;
            case '3':
                $busqueda->insCodigo = $insUsuario;
                $dataProvider = $busqueda->searchAdmin($parametros);
                break;
            case '4':
                $busqueda->usuEncargado = Yii::$app->user->identity->usuCodigo;
                $dataProvider = $busqueda->search($parametros);
                break;
        }

        return $this->render('index', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider ?? "",
            'institucionLista' => Institucion::detectarInstituciones($rolUsuario, $insUsuario),
            'rolActivo' => $rolTomado[0]['rolNumero'],
        ]);
    }


    /**
     * Displays a single Usuarios model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'rolActivo' => Roles::BusquedaRol($rolUsuario)
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $_id
     * @return mixed
     */
    public function actionInformacion()
    {
        return $this->render('informacion', [
            'model' => $this->findModel(Yii::$app->user->identity->usuCodigo),
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
            if (isset($_POST['tablaDatos'])) {

                $model->usuCodigo = bin2hex(openssl_random_pseudo_bytes(20));
                $model->contrasena = hash('sha512', $_POST['User']['contrasena']);

                $model = self::ingredoEspecial($model, $rolUsuario, $insUsuario);
                $rolUsuarioSeleccionado = $_POST['User']['rolCodigo'] ?? $model->rolCodigo;

                if ($rolUsuarioSeleccionado == Roles::indiceRol(Roles::listarRoles(), "Super Administrador")) {
                    $model->usuEncargado = $model->usuCodigo;
                }

                try {
                    if ($model->save()) {

                        self::GuardarTelefonos($model, $_POST['tablaDatos']);
                        self::GuardarModulosUsuario($model);
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

        return $this->render('create', [
            'model' => $model,
            'errorMensaje' => $error ?? '',
            'fechaActual' => date("Y-m-d"),
            'parametro' => substr(Roles::indiceRol(Roles::listarRoles(), "Super Administrador"), 0, 10),
            'rolesLista' => Roles::detectarRoles($rolUsuario),
            'institucionLista' => Institucion::detectarInstituciones($rolUsuario, $insUsuario),
        ]);
    }
    private function ingredoEspecial($model, $rolUsuario, $insUsuario)
    {
        $rolesUsuario = Roles::detectarRoles($rolUsuario);
        $institucionUsuario = Institucion::detectarInstituciones($rolUsuario, $insUsuario);
        if (count($rolesUsuario) == 2) {
            $contador = 0;
            $rolSeleccion = '';
            foreach ($rolesUsuario as $key => $value) {
                if ($contador > 0) {
                    $rolSeleccion = $key;
                }
                $contador++;
            }
            $model->rolCodigo = $rolSeleccion;


            $claveIns = "";
            foreach ($institucionUsuario as $key => $value) {
                $claveIns = $key;
            }
            $claveRol = "";
            foreach ($rolesUsuario as $key => $value) {
                $claveRol = $key;
            }

            $listaUsuariosSeleccion = User::listarUsuarios($claveIns, $claveRol, 'Profesor')->listCompleto;
            $contador = 0;
            $UsuariosSeleccion = '';
            foreach ($listaUsuariosSeleccion as $key => $value) {
                if ($contador > 0) {
                    $UsuariosSeleccion = $key;
                }
                $contador++;
            }
            $model->usuEncargado = $UsuariosSeleccion;
        }
        if (count($institucionUsuario) == 2) {
            $contador = 0;
            $institucionSeleccion = '';
            foreach ($institucionUsuario as $key => $value) {
                if ($contador > 0) {
                    $institucionSeleccion = $key;
                }
                $contador++;
            }
            $model->insCodigo = $institucionSeleccion;
        }
        return $model;
    }


    private function GuardarTelefonos($model, $tablaDatos, $accion = 'create', $id = "")
    {

        if ($accion == 'update') {
            $modelTelefonoEliminar = telefonousuario::BusquedaTelefonoModelo($id);
            foreach ($modelTelefonoEliminar as $value) {
                $value->delete();
            }
        }
        $datos = $tablaDatos;
        foreach ($datos as $dato) {
            $modelTelefono = new telefonousuario();
            $modelTelefono->usuCodigo = $model->usuCodigo;
            $modelTelefono->NumeroTelf = $dato;
            $modelTelefono->save();
        }
    }

    private function GuardarModulosUsuario($model, $accion = 'create', $id = "")
    {
        if ($accion == 'update') {
            $modelRelacionModulosUsuarioEliminar = TieneModulosUsuarios::BusquedaModulosUsuarioModelo($id);
            foreach ($modelRelacionModulosUsuarioEliminar as $value) {
                $value->delete();
            }
        }
        $relacionesModulosRoles = RelacionModulos::listarRelacionModulosRol($model->rolCodigo);
        foreach ($relacionesModulosRoles as $datoModulos) {
            $modelModulosUsuarios = new TieneModulosUsuarios();
            $modelModulosUsuarios->relCodigo = $datoModulos['relCodigo'];
            $modelModulosUsuarios->usuCodigo = $model->usuCodigo;
            $modelModulosUsuarios->tieEstado = Params::ESTADOOK;
            $modelModulosUsuarios->save();
        }
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

                $model = self::ingredoEspecial($model, $rolUsuario, $insUsuario);
                $rolUsuarioSeleccionado = $_POST['User']['rolCodigo'] ?? $model->rolCodigo;

                if ($rolUsuarioSeleccionado == Roles::indiceRol(Roles::listarRoles(), "Super Administrador")) {
                    $model->usuEncargado = $model->usuCodigo;
                }
                try {
                    if ($model->save()) {
                        self::GuardarTelefonos($model, $_POST['tablaDatos'], 'update', $id);
                        self::GuardarModulosUsuario($model, 'update', $id);
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
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Usuarios the loaded model
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
    public function actionDisabled($id)
    {
        $respuesta = new \stdClass;
        $respuesta->correcto = false;

        $model = $this->findModel($id);
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        $rolTomado = Roles::BusquedaRol($rolUsuario);
        if (($model->usuEncargado == Yii::$app->user->identity->usuCodigo || $rolTomado[0]['rolNumero'] == '2') || ($rolTomado[0]['rolNumero'] == '3' && $model->insCodigo == Yii::$app->user->identity->insCodigo)) {
            $model->estado = Params::ESTADOINACTIVO;
            if ($model->save()) {
                $respuesta->correcto = true;
                $respuesta->url = "index.php?r=usuarios/index";
                $respuesta->mensajeCorrecto = "Se ha desactivado correctamente: " . $model->nombre1 . ' ' . $model->apellido1;
                $respuesta->tiempoActualizar = 3000;
            } else {
                $respuesta->error = "No se ha podido desactivar el usuario, por favor volver a intentarlo.";
            }
        } else {
            $respuesta->error = "No puede desactivar este usuario sin permiso, por favor contáctese con el super administrador.";
        }
        return  json_encode($respuesta);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $respuesta = new \stdClass;
        $respuesta->correcto = false;

        $model = $this->findModel($id);
        $rolTomado = Roles::BusquedaRol(Yii::$app->user->identity->rolCodigo);
        if ($rolTomado[0]['rolNumero'] == '3' || $rolTomado[0]['rolNumero'] == '2') {
            $nombreUsuario = $model->nombre1 . ' ' . $model->apellido1;
            if ($model->delete()) {
                $respuesta->correcto = true;
                $respuesta->url = "index.php?r=usuarios/index";
                $respuesta->mensajeCorrecto = "Se ha eliminado todas las relaciones que tiene el usuario: " . $nombreUsuario;
                $respuesta->tiempoActualizar  = 10000;
            } else {
                $respuesta->error = "No se ha podido eliminar el usuario, por favor volver a intentarlo.";
            }
        } else {
            $respuesta->error = "No puede eliminar este usuario sin permiso, por favor contáctese con el super administrador.";
        }

        return  json_encode($respuesta);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBuscarUsuarios($idInstitucion, $rolSeleccionado)
    {
        return  json_encode(User::listarUsuarios($idInstitucion, $rolSeleccionado));
    }
}
