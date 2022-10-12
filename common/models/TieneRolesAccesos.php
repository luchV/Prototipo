<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for collection "TieneRolesAccesos".
 *
 * @property mixed|string $rolCodigo
 * @property mixed $accCodigo
 * @property mixed $nombreAcceso
 */
class TieneRolesAccesos extends ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%tienerolesaccesos}}';
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      'rolCodigo',
      'accCodigo',
      'nombreAcceso',
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['rolCodigo', 'accCodigo', 'nombreAcceso'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'nombreAcceso' => Yii::t('app', 'Nombre de acceso'),
    ];
  }

  /**
   * @return TieneRolesAccesos[]
   *
   */
  public static function listarRolesAccesos(
    string $accCodigo
  ): array {
    return TieneRolesAccesos::find()
      ->where([
        'accCodigo' => $accCodigo,
      ])->asArray()->all();
  }
}