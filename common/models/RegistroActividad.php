<?php

namespace common\models;

use DateTime;
use yii\db\ActiveRecord;
use Yii;
use Exception;
use ReflectionObject;

/**
 * This is the model class for collection "Reportes".
 *
 * @property mixed|string $usuCodigo
 * @property mixed $NumeroTelf
 */
class RegistroActividad extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%registroactividad}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'regCodigo',
            'numeroAciertos',
            'tiempoTrascurrido',
            'fechaEjecucion',
            'numeroErrores',
            'usuCodigo',
            'insCodigo',
            'usuEncargado',
            'secCodigo',
            'modCodigo'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numeroAciertos', 'tiempoTrascurrido', 'fechaEjecucion', 'numeroErrores', 'usuCodigo', 'insCodigo', 'secCodigo', 'modCodigo'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'numeroAciertos' => Yii::t('app', 'Número de aciertos'),
            'numeroErrores' => Yii::t('app', 'Número de errores'),
            'tiempoTrascurrido' => Yii::t('app', 'Tiempo trascurrido'),
            'fechaEjecucion' => Yii::t('app', 'Fecha de ejecución'),
            'usuCodigo' => Yii::t('app', 'Usuario'),
            'insCodigo' => Yii::t('app', 'Institución'),
            'usuEncargado' => Yii::t('app', 'Usuario encargado'),
            'secCodigo' => Yii::t('app', 'Última actividad'),
            'modCodigo' => Yii::t('app', 'Módulo'),
        ];
    }

    public static function guardarRegistroActividad($numeroAciertos, $tiempoTrascurrido, $numeroErrores, $secCodigo, $modCodigo)
    {
        $respuesta = new \stdClass();
        $respuesta->correcto = false;
        try {
            $reporteGuardar = new RegistroActividad();
            $reporteGuardar->regCodigo = bin2hex(openssl_random_pseudo_bytes(20));
            $reporteGuardar->numeroAciertos = $numeroAciertos;
            $reporteGuardar->tiempoTrascurrido = $tiempoTrascurrido;
            $reporteGuardar->numeroErrores = $numeroErrores;
            $fecha = new DateTime("now");
            $reporteGuardar->fechaEjecucion =  $fecha->format("Y-m-d");
            $reporteGuardar->usuCodigo =  Yii::$app->user->identity->usuCodigo;
            $reporteGuardar->insCodigo =  Yii::$app->user->identity->insCodigo;
            $reporteGuardar->usuEncargado =  Yii::$app->user->identity->usuEncargado;
            $reporteGuardar->secCodigo = $secCodigo;
            $reporteGuardar->modCodigo = $modCodigo;
            if ($reporteGuardar->save()) {
                $respuesta->correcto = true;
            } else {
                $respuesta->error = "No se pudo guardar la actividad";
            }
        } catch (Exception $e) {
            $respuesta = new \stdClass();
            $respuesta->correcto = false;
            $respuesta->error = $e->getMessage();
            $respuesta->errorCodigo = $e->getCode();
            $respuesta->errorLinea = $e->getLine();
        }

        return $respuesta;
    }
}
