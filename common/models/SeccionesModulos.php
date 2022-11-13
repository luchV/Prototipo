<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for collection "SeccionesModulos".
 *
 * @property mixed $secCodigo
 * @property mixed $secPregunta
 * @property mixed $secNumeroPregunta
 * @property mixed $secTipoRespuesta
 * @property mixed $secEstado
 * @property mixed $modCodigo
 * @property mixed $usuCodigo
 */
class SeccionesModulos extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seccionesmodulos}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'secCodigo',
            'secPregunta',
            'seccSubpregunta',
            'secNumeroPregunta',
            'secTipoRespuesta',
            'secEstado',
            'seccAudioSubPregunta',
            'seccAudioPregunta',
            'modCodigo',
            'usuCodigo',
            'seccPreguntaAdicional',
            'seccAudioPreguntaAdicional',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'secCodigo',
                    'secPregunta',
                    'seccSubpregunta',
                    'secNumeroPregunta',
                    'secTipoRespuesta',
                    'secEstado',
                    'seccAudioSubPregunta',
                    'seccAudioPregunta',
                    'modCodigo',
                    'usuCodigo',
                    'seccPreguntaAdicional',
                    'seccAudioPreguntaAdicional',
                ], 'safe'
            ],
            [
                [
                    'secPregunta',
                    'secNumeroPregunta',
                    'secTipoRespuesta',
                    'seccAudioPregunta',
                    'secEstado',
                ], 'required', 'message' => 'Campo obligatorio.', 'on' => 'registro2'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'secPregunta' => Yii::t('app', 'Orden Principal'),
            'seccSubpregunta' => Yii::t('app', 'Orden Secundaria'),
            'secNumeroPregunta' => Yii::t('app', 'Número de actividad'),
            'secTipoRespuesta' => Yii::t('app', 'Tipo de actividad'),
            'seccAudioSubPregunta' => Yii::t('app', 'URL del audio para la orden secundaria'),
            'seccAudioPregunta' => Yii::t('app', 'URL del audio para la orden principal'),
            'secEstado' => Yii::t('app', 'Estado de la actividad'),
            'seccPreguntaAdicional' => Yii::t('app', 'Orden Terciaria'),
            'seccAudioPreguntaAdicional' => Yii::t('app', 'URL del audio para en la orden terciaria'),
        ];
    }

    /**
     * @return SeccionesModulos[]
     *
     */
    public static function BusquedaSecciones($modCodigo, $usoCodigo): array
    {
        return SeccionesModulos::find()
            ->where([
                'modCodigo' => $modCodigo,
                'usuCodigo' => $usoCodigo,
            ])->asArray()->all();
    }

    /**
     * @return SeccionesModulos[]
     *
     */
    public static function BusquedaSeccionesModulo($secCodigo)
    {
        return SeccionesModulos::findOne(['secCodigo' => $secCodigo]);
    }
}
