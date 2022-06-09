<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "Menus".
 *
 * @property \MongoId|string $_id
 * @property mixed $id_Padre
 * @property mixed $secc_pregunta
 * @property mixed $secc_respuestas
 * @property mixed $secc_tipo_respuestas
 * @property mixed $secc_numero_pregunta
 * @property mixed $ins_codigo
 */
class SeccionesMenu extends \yii\mongodb\ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function collectionName()
  {
    $bd = validarBase();

    return [$bd, 'seccionesMenu'];
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      '_id',
      'id_Padre',
      'secc_pregunta',
      'secc_respuestas',
      'secc_tipo_respuestas',
      'secc_numero_pregunta',
      'ins_codigo',
      'secc_subpregunta',
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id_Padre', 'secc_pregunta', 'secc_respuestas', 'secc_tipo_respuestas','secc_numero_pregunta','secc_subpregunta'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      '_id' => Yii::t('app', 'ID'),
    ];
  }

  public static function listarSecciones(
    string $ins_codigo,
    int $id_Padre
  ): array {
    return seccionesMenu::find()
      ->where([
        'ins_codigo' => $ins_codigo,
        'id_Padre' => $id_Padre
      ])->orderBy('secc_numero_pregunta ASC')
      ->asArray()->all();
  }
}
