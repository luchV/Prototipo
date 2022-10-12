<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for collection "Roles".
 *
 * @property mixed|string $rolCodigo
 * @property mixed $rolNumero
 * @property mixed $rolNombre
 */
class Roles extends ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%roles}}';
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      'rolCodigo',
      'rolNumero',
      'rolNombre',
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['rolCodigo', 'rolNumero', 'rolNombre'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'rolNombre' => Yii::t('app', 'Nombre de rol'),
    ];
  }

  /**
   * @return Roles[]
   *
   */
  public static function listarRol(
    string $rolCodigo
  ): array {
    return Roles::find()
      ->where([
        'rolCodigo' => $rolCodigo,
      ])->asArray()->all();
  }
}
