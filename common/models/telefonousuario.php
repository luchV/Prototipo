<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for collection "telefonousuario".
 *
 * @property mixed|string $usuCodigo
 * @property mixed $NumeroTelf
 */
class telefonousuario extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%telefonousuario}}';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'usuCodigo',
            'NumeroTelf',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuCodigo', 'NumeroTelf'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NumeroTelf' => Yii::t('app', 'Numero de telefono'),
        ];
    }

    /**
     * @return telefonousuario[]
     *
     */
    public static function BusquedaTelefono(
        string $usuCodigo
    ): array {
        return telefonousuario::find()
            ->where([
                'usuCodigo' => $usuCodigo,
            ])->asArray()->all();
    }

    /**
     * @return telefonousuario[]
     *
     */
    public static function BusquedaTelefonoModelo(
        string $usuCodigo
    ) {
        return telefonousuario::find(['usuCodigo' => $usuCodigo])->all();
    }
    public static function primaryKey()
    {
        return ["usuCodigo"];
    }
}
