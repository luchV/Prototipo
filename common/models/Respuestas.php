<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use Exception;

/**
 * This is the model class for collection "Reportes".
 *
 * @property mixed|string $usuCodigo
 * @property mixed $NumeroTelf
 */
class Respuestas extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%respuestas}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'resCodigo',
            'resNumero',
            'respuestaCorrecto',
            'respuestaTexto',
            'imagen',
            'secCodigo',
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
                    'resCodigo',
                    'resNumero',
                    'respuestaCorrecto',
                    'respuestaTexto',
                    'imagen',
                    'secCodigo',
                ], 'safe'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'resNumero' => Yii::t('app', 'Respuesta N.'),
            'respuestaCorrecto' => Yii::t('app', 'Tipo de respuesta'),
            'respuestaTexto' => Yii::t('app', 'Respuesta en Texto'),
            'imagen' => Yii::t('app', 'Id de la imagen'),
        ];
    }
}
