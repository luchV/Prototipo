<?php

namespace backend\controllers;

use Yii;
use common\models\RegistroActividad;
use backend\models\search\ReportesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\helpers\ControlRoles;
use common\models\Params;
use common\models\Roles;
use common\models\User;
use ptrnov\fusionchart\Chart;

/**
 * ReportesController implements the CRUD actions for Reportes model.
 */
class ReportesController extends Controller
{
    public function behaviors()
    {
        $respuesta = ControlRoles::Roles("3");
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
    public function actionReporteGeneral()
    {
        $model = new RegistroActividad();
        $consultarFecha = $model->load(Yii::$app->request->post());

        $fecha = self::obtenerFecha($consultarFecha, $model, 'FechaRG');
        $busqueda = new ReportesSearch();
        $rolTomado = Roles::BusquedaRol(Yii::$app->user->identity->rolCodigo);

        switch ($rolTomado[0]['rolNumero']) {
            case '2':
                $busquedaInstitucion = true;
                break;
            case '3':
                $busqueda->insCodigo = Yii::$app->user->identity->insCodigo;
                $busquedaInstitucion = false;
                break;
            case '4':
                $busquedaInstitucion = false;
                $busqueda->insCodigo = Yii::$app->user->identity->insCodigo;
                $busqueda->usuEncargado = Yii::$app->user->identity->usuCodigo;
                break;
        }

        $fechasBusqueda = explode("/", $fecha);
        $busqueda->start = trim($fechasBusqueda[0]);
        $busqueda->end = trim($fechasBusqueda[1]);
        $dataProvider = $busqueda->search(Yii::$app->request->queryParams);

        $busquedaSQL = 'SELECT *, count(`regCodigo`) as count,
        sum(`tiempoTrascurrido`) as totalTiempo,
        sum(`numeroErrores`) as totalError,
        sum(`numeroAciertos`) as totalAciertos
        FROM `registroactividad`
        WHERE ' . self::obtenerConsultaWhere($dataProvider->query->where) . ' 
        GROUP BY `fechaEjecucion`';

        return $this->render('reporteGeneral', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'fecha' => $fecha,
            'busquedaInstitucion' => $busquedaInstitucion,
            'respuestaGrafico' => self::obtenerGraficoBusqueda(
                $busquedaSQL,
                'Reporte General',
                'Reporte de fechas',
                'Fechas',
                'Total registros',
                ['fechaEjecucion', 'count']
            ),
        ]);
    }
    /**
     * Lists all Institucion models.
     * @return mixed
     */
    public function actionReporteBusqueda()
    {
        
        $model = new User();
        $consultarCedula = $model->load(Yii::$app->request->post());
        $cedula = self::obtenerCedula($consultarCedula, $model, 'cedulaU');

        if ($cedula == '') {
            unset($_SESSION['cedulaU']);
            return $this->render('reporteBusqueda', [
                'mensajeError' => ' ',
                'cedulaUsuario' => '',
            ]);
        }

        $busqueda = new ReportesSearch();
        $rolTomado = Roles::BusquedaRol(Yii::$app->user->identity->rolCodigo);

        $cedulaUsuario = $cedula;
        switch ($rolTomado[0]['rolNumero']) {
            case '2':
                $busquedaInstitucion = true;
                $consulta = ['estado' => Params::ESTADOOK, 'cedula' => $cedulaUsuario];
                break;
            case '3':
                $busqueda->insCodigo = Yii::$app->user->identity->insCodigo;
                $consulta = ['estado' => Params::ESTADOOK, 'cedula' => $cedulaUsuario, 'insCodigo' => $busqueda->insCodigo];
                $busquedaInstitucion = false;
                break;
            case '4':
                $busquedaInstitucion = false;
                $busqueda->insCodigo = Yii::$app->user->identity->insCodigo;
                $busqueda->usuEncargado = Yii::$app->user->identity->usuCodigo;
                $consulta = ['estado' => Params::ESTADOOK, 'cedula' => $cedulaUsuario, 'insCodigo' => $busqueda->insCodigo, 'usuEncargado' => $busqueda->usuEncargado];
                break;
        }

        $usuarioBusqueda = User::busquedaUsuarioCedula($consulta);

        if (is_null($usuarioBusqueda)) {
            unset($_SESSION['cedulaU']);
            return $this->render('reporteBusqueda', [
                'mensajeError' => 'El usuario no existe',
                'cedulaUsuario' => $cedulaUsuario,
            ]);
        }

        $busqueda->usuCodigo = $usuarioBusqueda['usuCodigo'];
        $dataProvider = $busqueda->searchUsuario(Yii::$app->request->queryParams);

        $busquedaSQL = 'SELECT *, count(`regCodigo`) as count,
        sum(`tiempoTrascurrido`) as totalTiempo,
        sum(`numeroErrores`) as totalError,
        sum(`numeroAciertos`) as totalAciertos
        FROM `registroactividad`
        WHERE ' . self::obtenerConsultaWhere($dataProvider->query->where) . ' 
        GROUP BY `fechaEjecucion`';

        return $this->render('reporteBusqueda', [
            'searchModel' => $busqueda,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'busquedaInstitucion' => $busquedaInstitucion,
            'respuestaGrafico' => self::obtenerGraficoBusqueda(
                $busquedaSQL,
                'Reporte General',
                'Reporte de fechas',
                'Fechas',
                'Total registros',
                ['fechaEjecucion', 'count']
            ),
            'cedulaUsuario' => $cedulaUsuario,
            'mensajeError' => '',
            'modelUsuario' => $usuarioBusqueda,
        ]);
    }

    private function obtenerCedula($consultarCedula, $model, $nombreFecha)
    {
        if ($consultarCedula) {
            $cedulaUsuario = $model->cedula;
            $_SESSION[$nombreFecha] = $cedulaUsuario;
        } else {
            if (isset($_SESSION[$nombreFecha])) {
                $cedulaUsuario = $_SESSION[$nombreFecha];
            } else {
                $cedulaUsuario = '';
                $_SESSION[$nombreFecha]='';
            }
        }
        return $cedulaUsuario;
    }

    private function obtenerGraficoBusqueda($busquedaSQL, $titulo, $subtitulo, $nombreX, $nombreY, $camposGrafico)
    {
        $respuesta = new \stdClass;
        $respuesta->correcto = false;
        $model3 =  Yii::$app->db->createCommand($busquedaSQL)
            ->queryAll();

        $respuesta->totalTiempo = 0;
        $respuesta->totalError = 0;
        $respuesta->totalAciertos = 0;
        foreach ($model3 as $value) {
            $respuesta->totalTiempo += $value['totalTiempo'];
            $respuesta->totalError += $value['totalError'];
            $respuesta->totalAciertos += $value['totalAciertos'];
        }

        if (count($model3) > 0) {
            $respuesta->chartSale = Chart::Widget([
                'dataArray' => $model3,
                'dataField' => $camposGrafico,
                'type' => 'column3d',
                'renderid' => 'chartSale',
                'chartOption' => [
                    'caption' => Yii::t('app', $titulo),
                    'subCaption' => Yii::t('app', $subtitulo),
                    'xaxisName' => Yii::t('app', $nombreX),
                    'yaxisName' => Yii::t('app', $nombreY),
                    'theme' => 'fusion',
                    'palettecolors' => "#FCE7E6,#008ee4,#f8bd19,#e44a00,#6baa01,#ff2e2e",
                    'bgColor' => "#ffffff",
                    'showBorder' => "0",
                    'showCanvasBorder' => "0",
                ],
            ]);
            $respuesta->correcto = true;
        }

        return $respuesta;
    }

    private function obtenerConsultaWhere($consulta)
    {
        if ($consulta[0] != 'and') {
            return '(`' . $consulta[1] . '` ' . $consulta[0] . ' "' . $consulta[2] . '")';
        }

        $consultaCuadro = "";
        $contador = 1;
        foreach ($consulta as $key => $value) {
            if ($key != 0) {
                if ($contador < (count($consulta) - 1)) {
                    $consultaCuadro = $consultaCuadro . '(`' . $value[1] . '` ' . $value[0] . ' "' . $value[2] . '") AND ';
                    $contador++;
                } else {
                    $consultaCuadro = $consultaCuadro . '(`' . $value[1] . '` ' . $value[0] . ' "' . $value[2] . '")';
                }
            }
        }
        return $consultaCuadro;
    }

    private function obtenerFecha($consultarFecha, $model, $nombreFecha)
    {
        if ($consultarFecha) {
            $fechaMostrar = $model->fechaEjecucion;
            $_SESSION[$nombreFecha] = $fechaMostrar;
        } else {
            if (isset($_SESSION[$nombreFecha])) {
                $fechaMostrar = $_SESSION[$nombreFecha];
            } else {
                $fechaHoy = date('Y-m-d');
                $fechaAntes = date("Y-m-d", strtotime("-" . 7 . " days"));
                $fechaMostrar = $fechaAntes . ' / ' . $fechaHoy;
            }
        }
        return $fechaMostrar;
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
        if (($model = RegistroActividad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
