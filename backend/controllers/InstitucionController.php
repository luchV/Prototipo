<?php

namespace backend\controllers;

use Yii;
use common\models\Institucion;
use common\models\Params;
use backend\models\search\InstitucionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\helpers\ControlRoles;
use common\models\Roles;

/**
 * InstitucionController implements the CRUD actions for Institucion model.
 */
class InstitucionController extends Controller
{
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

    //PARA CONSUMIR WEBSERVICES
    public function beforeAction($action)
    {
        date_default_timezone_set("America/Guayaquil");
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Institucion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $busqueda = new InstitucionSearch();
        $dataProvider = $busqueda->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Institucion model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        $rolUsuario = Yii::$app->user->identity->rolCodigo;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'rolActivo' => Roles::BusquedaRol($rolUsuario),
        ]);
    }


    /**
     * Creates a new Institucion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Institucion();
        $model->scenario = 'registro';

        if ($model->load(Yii::$app->request->post())) {
            $model->insCodigo = bin2hex(openssl_random_pseudo_bytes(20));
            $model->insEstado = $_POST['insEstado'];

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                $error = 'Se produjo un error al momento de realizar la acción.';
            }
        }
        return $this->render('create', [
            'model' => $model,
            'errorMensaje' => $error ?? ''
        ]);
    }

    /**
     * Updates an existing Institucion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'registro';

        if ($model->load(Yii::$app->request->post())) {

            $model->insEstado = $_POST['insEstado'];

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                $error = 'Se produjo un error al momento de realizar la acción.';
            }
        }
        return $this->render('update', [
            'model' => $model,
            'errorMensaje' => $error ?? ''
        ]);
    }

    /**
     * Deletes an existing Institucion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDisabled($id)
    {
        $respuesta = new \stdClass;
        $respuesta->correcto = false;

        $model = $this->findModel($id);
        $model->insEstado = Params::ESTADOINACTIVO;
        if ($model->save()) {
            $respuesta->correcto = true;
            $respuesta->url = "index.php?r=institucion/index";
            $respuesta->mensajeCorrecto = "Se ha desactivado correctamente: " . $model->insNombre;
            $respuesta->tiempoActualizar = 3000;
        } else {
            $respuesta->error = "No se ha podido desactivar la institución, por favor volver a intentarlo.";
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
        $nombreInstitucion = $model->insNombre;
        if ($model->delete()) {
            $respuesta->correcto = true;
            $respuesta->url = "index.php?r=institucion/index";
            $respuesta->mensajeCorrecto = "Se ha eliminado todas las relaciones que tiene la institución: " . $nombreInstitucion;
            $respuesta->tiempoActualizar  = 10000;
        } else {
            $respuesta->error = "No se ha podido eliminar la institución, por favor volver a intentarlo.";
        }

        return  json_encode($respuesta);
    }

    /**
     * Finds the Institucion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Institucion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Institucion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
