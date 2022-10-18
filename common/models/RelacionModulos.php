<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for collection "Menus".
 *
 * @property mixed|string $relCodigo
 * @property mixed $relEstado
 * @property mixed $modCodigo
 * @property mixed $rolCodigo
 */
class RelacionModulos extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relacionmodulos}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'relCodigo',
            'relEstado',
            'modCodigo',
            'rolCodigo',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relCodigo', 'relEstado', 'modCodigo', 'rolCodigo'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'relEstado' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * @return RelacionModulos[]
     *
     */
    public static function listarRelacionModulos(
        string $relCodigo
    ): array {
        return RelacionModulos::find()
            ->where([
                'relCodigo' => $relCodigo,
                'relEstado' => Params::ESTADOOK
            ])->asArray()->all();
    }

    /**
     * @return RelacionModulos[]
     *
     */
    public static function listarRelacionModulosRol(
        string $rolCodigo
    ): array {
        return RelacionModulos::find()
            ->where([
                'rolCodigo' => $rolCodigo,
                'relEstado' => Params::ESTADOOK
            ])->asArray()->all();
    }
}
