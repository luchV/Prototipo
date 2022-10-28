<?php

namespace common\models;

use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for collection "Accesos".
 *
 * @property mixed|string $accCodigo
 * @property mixed $accNumero
 */
class Accesos extends ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%accesos}}';
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      'accCodigo',
      'accNumero',
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['accCodigo', 'accNumero'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'accNumero' => Yii::t('app', 'Número de acceso'),
    ];
  }

  /**
   * @return Accesos[]
   *
   */
  public static function listarAccesos(
    string $accNumero
  ): array {
    return Accesos::find()
      ->where([
        'accNumero' => $accNumero,
      ])->asArray()->all();
  }
}