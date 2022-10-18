<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for collection "TieneModulosUsuarios".
 *
 * @property mixed|string $relCodigo
 * @property mixed $usuCodigo
 * @property mixed $tieEstado
 */
class TieneModulosUsuarios extends ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%tienemodulosusuarios}}';
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      'relCodigo',
      'usuCodigo',
      'tieEstado',
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['relCodigo', 'usuCodigo', 'tieEstado'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'tieEstado' => Yii::t('app', 'Estado'),
    ];
  }

  /**
   * @return TieneModulosUsuarios[]
   *
   */
  public static function listarModulosUsuarios(
    string $usuCodigo
  ): array {
    return TieneModulosUsuarios::find()
      ->where([
        'usuCodigo' => $usuCodigo,
        'tieEstado' => Params::ESTADOOK
      ])->asArray()->all();
  }

  public static function findByIdPadre($id_Padre, $ins_codigo)
  {
    return TieneModulosUsuarios::find()->where([
      'id_Padre' => $id_Padre,
      'ins_codigo' => $ins_codigo,
    ])->one();
  }

  /**
   * @return TieneModulosUsuarios[]
   *
   */
  public static function BusquedaModulosUsuarioModelo(
    string $usuCodigo
  ) {
    return TieneModulosUsuarios::find()->where(['usuCodigo' => $usuCodigo, 'tieEstado' => Params::ESTADOOK])->all();
  }
  public static function primaryKey()
  {
    return ["usuCodigo"];
  }
}
