<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for collection "Menus".
 *
 * @property mixed|string $modCodigo
 * @property mixed $modNombre
 * @property mixed $modUrl
 * @property mixed $modIcono
 * @property mixed $modOrden
 */
class Modulos extends ActiveRecord
{
    #Secciones:
    const SECCION_ACTIVIDADES = 'actividades';
    const SECCION_ADMINISTRACION = 'administracion';
    const SECCION_REPORTES = 'reportes';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%modulos}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'modCodigo',
            'modNombre',
            'modUrl',
            'modIcono',
            'modOrden',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modCodigo', 'modNombre', 'modUrl', 'modIcono', 'modOrden'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'modNombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return Modulos[]
     *
     */
    public static function listarModulos(
        string $modCodigo
    ): array {
        return Modulos::find()
            ->where([
                'modCodigo' => $modCodigo,
            ])->orderBy('modOrden')->asArray()->all();
    }
}
