<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for collection "Modulos".
 *
 * @property mixed|string $modCodigo
 * @property mixed $modNombre
 * @property mixed $modUrl
 * @property mixed $modIcono
 * @property mixed $modOrden
 * @property mixed $modSeccion
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
            'modSeccion',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modCodigo', 'modNombre', 'modUrl', 'modIcono', 'modOrden', 'modSeccion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'modNombre' => Yii::t('app', 'Nombre de la actividad'),
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
            ])->asArray()->all();
    }

    public static function listarModulosFiltro()
    {
        $list = ArrayHelper::map(Modulos::find()->where(['modSeccion'=>'actividades'])->orderBy('modOrden')->all(), function ($model_aux) {
            return (string)$model_aux->modNombre;
        }, 'modNombre');

        $Opcion1 = array(null => "Seleccionar");
        $listCompleto = $Opcion1 + $list;

        return  $listCompleto;
    }
    public static function listarModulosCodigoFiltro()
    {
        $list = ArrayHelper::map(Modulos::find()->where(['modSeccion'=>'actividades'])->orderBy('modOrden')->all(), function ($model_aux) {
            return (string)$model_aux->modCodigo;
        }, 'modNombre');

        $Opcion1 = array(null => "Seleccionar");
        $listCompleto = $Opcion1 + $list;

        return  $listCompleto;
    }
}
