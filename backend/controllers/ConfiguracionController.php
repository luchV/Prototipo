<?php

namespace backend\controllers;

use Yii;
use common\models\SeccionesModulos;
use backend\models\search\SeccionesSearch;
use common\models\Params;
use backend\models\search\ModulosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\helpers\ControlRoles;
use common\helpers\FuncionesGenerales;
use common\models\Roles;
use common\models\Respuestas;

/**
 * SeccionesModulosController implements the CRUD actions for SeccionesModulos model.
 */
class ConfiguracionController extends Controller
{
    public function behaviors()
    {
        $respuesta = ControlRoles::Roles("4");
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
     * Lists all SeccionesModulos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $busqueda = new ModulosSearch();
        $busqueda->modSeccion = "actividades";
        $dataProvider = $busqueda->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new SeccionesModulos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePregunta($idModulo)
    {
        $modelID = $this->findModel($idModulo);

        $model = new SeccionesModulos();
        $model->scenario = 'registro2';

        $totalPreguntas = count(SeccionesModulos::BusquedaSecciones($idModulo, Yii::$app->user->identity->usuCodigo));
        $modelRespuestas = new Respuestas();

        if ($totalPreguntas >= 5) {
            return $this->render('mensajeError', [
                'mensaje' => "No puede crear más actividads"
            ]);
        }
        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['elementosRespuestas'])) {
                $model->secCodigo = bin2hex(openssl_random_pseudo_bytes(20));
                $model->secNumeroPregunta = ($totalPreguntas + 1) . '';
                $model->modCodigo = $idModulo;
                $model->usuCodigo = Yii::$app->user->identity->usuCodigo;

                $model->seccAudioPregunta = FuncionesGenerales::obtenerEnlace($model->seccAudioPregunta);
                $model->seccAudioSubPregunta = FuncionesGenerales::obtenerEnlace($model->seccAudioPregunta);
                $model->seccAudioPreguntaAdicional = FuncionesGenerales::obtenerEnlace($model->seccAudioPregunta);

                if ($model->save()) {
                    //Campos de preguntas
                    self::GuardarRespuestas($model,  $_POST['elementosRespuestas']);
                    return $this->redirect(['update', 'id' => $idModulo]);
                }
                $error = 'Se produjo un error al momento de realizar la acción.';
            } else {
                $error = 'Por favor ingresar respuestas para la actividad.';
            }
        }
        if (isset($_POST['activarPreguntaAdicional'])) {
            $botonActivado = "checked";
        }
        return $this->render('create', [
            'model' => $model,
            'modelID' => $modelID,
            'totalPreguntas' => $totalPreguntas + 1,
            'totalRespuestas' => 0,
            'modelRespuestas' => $modelRespuestas,
            'errorMensaje' => $error ?? '',
            'activado' => $botonActivado ?? '',
        ]);
    }

    private function GuardarRespuestas($model, $tablaDatos, $accion = 'create', $id = "")
    {

        if ($accion == 'update') {
            $modelEliminar = $this->findModelRespuestaTodos($id);
            foreach ($modelEliminar as $value) {
                $value->delete();
            }
        }
        $numeroPregunta = 1;
        foreach ($tablaDatos as $elemento) {
            $infoRespuesta = explode("&", $elemento);
            $modelAux = new Respuestas();
            $modelAux->resCodigo = bin2hex(openssl_random_pseudo_bytes(20));
            $modelAux->resNumero = $numeroPregunta . '';
            $modelAux->respuestaCorrecto = $infoRespuesta[1];
            $modelAux->respuestaTexto = $infoRespuesta[2];
            $modelAux->imagen = FuncionesGenerales::obtenerEnlace($infoRespuesta[3]);
            $modelAux->secCodigo = $model->secCodigo;
            if ($modelAux->save()) {
                $numeroPregunta++;
            }
        }
    }

    /**
     * Updates an existing SeccionesModulos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdatePregunta($id)
    {
        $modelS = $this->findModelSeccion($id);
        $modelS->scenario = 'registro2';

        if ($modelS->usuCodigo != Yii::$app->user->identity->usuCodigo) {
            return $this->render('mensajeError', [
                'mensaje' => "No puede actualizar sin permiso"
            ]);
        }
        $model = $this->findModel($modelS->modCodigo);
        $modelRespuestaMuestra =  $this->findModelRespuestaTodos($modelS->secCodigo);
        $modelRespuestas = new Respuestas();

        if ($modelS->load(Yii::$app->request->post())) {
            if (isset($_POST['elementosRespuestas'])) {

                $modelS->seccAudioPregunta = FuncionesGenerales::obtenerEnlace($modelS->seccAudioPregunta);
                $modelS->seccAudioSubPregunta = FuncionesGenerales::obtenerEnlace($modelS->seccAudioSubPregunta);
                $modelS->seccAudioPreguntaAdicional = FuncionesGenerales::obtenerEnlace($modelS->seccAudioPreguntaAdicional);
                if ($modelS->save()) {
                    //Campos de preguntas
                    self::GuardarRespuestas($modelS, $_POST['elementosRespuestas'], 'update', $modelS->secCodigo);
                    return $this->redirect(['update', 'id' => $model->modCodigo]);
                }
                $error = 'Se produjo un error al momento de realizar la acción.';
            } else {
                $error = 'Por favor ingresar respuestas para la actividad.';
            }
        }
        if (isset($_POST['activarPreguntaAdicional']) || $modelS->seccPreguntaAdicional != "") {
            $botonActivado = "checked";
        }
        $modelS->seccAudioPregunta = FuncionesGenerales::ponerEnlace($modelS->seccAudioPregunta);
        $modelS->seccAudioSubPregunta = FuncionesGenerales::ponerEnlace($modelS->seccAudioSubPregunta);
        $modelS->seccAudioPreguntaAdicional = FuncionesGenerales::ponerEnlace($modelS->seccAudioPreguntaAdicional);
        return $this->render('update', [
            'model' => $modelS,
            'modelID' => $model,
            'totalPreguntas' => $modelS->secNumeroPregunta,
            'totalRespuestas' => count((array)$modelRespuestaMuestra) ?? 0,
            'modelRespuestas' => $modelRespuestas,
            'errorMensaje' => $error ?? '',
            'modelRespuestaMuestra' => $modelRespuestaMuestra,
            'activado' => $botonActivado ?? '',
        ]);
    }

    /**
     * Updates an existing SeccionesModulos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelID = $this->findModel($id);

        $busqueda = new SeccionesSearch();

        $busqueda->modCodigo = $modelID->modCodigo;
        $busqueda->usuCodigo = Yii::$app->user->identity->usuCodigo;
        $dataProvider = $busqueda->search(Yii::$app->request->queryParams);

        return $this->render('indexSeccion', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider,
            'modelID' => $modelID,
        ]);
    }

    /**
     * Displays a single SeccionesModulos model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelS = $this->findModelSeccion($id);
        if ($modelS->usuCodigo != Yii::$app->user->identity->usuCodigo) {
            return $this->render('mensajeError', [
                'mensaje' => "No puede visualizar sin permiso"
            ]);
        }
        $model = $this->findModel($modelS->modCodigo);
        return $this->render('view', [
            'model' => $modelS,
            'modelID' => $model,
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

        $model = $this->findModelSeccion($id);
        if ($model->usuCodigo != Yii::$app->user->identity->usuCodigo) {
            return $this->render('mensajeError', [
                'mensaje' => "No puede desabilitar sin permiso"
            ]);
        }
        $modelModelo = $this->findModel($model->modCodigo);

        $model->secEstado = Params::ESTADOINACTIVO;
        if ($model->save()) {
            $respuesta->correcto = true;
            $respuesta->url = "index.php?r=configuracion/update&id=" . $modelModelo->modCodigo;
            $respuesta->mensajeCorrecto = "Se ha desactivado correctamente: Actividad " . $model->secNumeroPregunta;
            $respuesta->tiempoActualizar = 3000;
        } else {
            $respuesta->error = "No se ha podido desactivar la actividad, por favor volver a intentarlo.";
        }
        return  json_encode($respuesta);
    }

    /**
     * Finds the SeccionesModulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return SeccionesModulos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
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
    protected function findModelSeccion($id)
    {
        if (($model = SeccionesModulos::findOne($id)) !== null) {
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
    protected function findModelRespuestaTodos($id)
    {
        if (($model = Respuestas::find()->where(['secCodigo' => $id])->orderBy('resNumero')->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
