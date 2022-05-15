<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "Menus".
 *
 * @property \MongoId|string $_id
 * @property mixed $men_nombre
 * @property mixed $men_icono
 * @property mixed $men_url
 * @property mixed $roles
 * @property mixed $ins_codigo
 */
class Menus extends \yii\mongodb\ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function collectionName()
  {
    $bd = validarBase();

    return [$bd, 'menus'];
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      '_id',
      'men_nombre',
      'men_icono',
      'men_url',
      'men_roles',
      'ins_codigo',
      'men_ordena'
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['men_nombre', 'men_icono', 'men_url', 'men_roles', 'ins_codigo','men_ordena'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      '_id' => Yii::t('app', 'ID'),
      'men_nombre' => Yii::t('app', 'Nombre'),
      'men_icono' => Yii::t('app', 'Clase'),
      'men_url' => Yii::t('app', 'Estado'),
      'ins_codigo' => Yii::t('app', 'Nivel'),
      'men_roles' => Yii::t('app', 'Orden'),
    ];
  }

  /**
   * @return Menus[]
   *
   */
  public static function listarMenuBackoffice(
    string $ins_codigo,
    int $men_roles
  ): array {
    return Menus::find()
      ->where([
        'ins_codigo' => $ins_codigo,
        'men_roles' => $men_roles
      ])->orderBy('men_ordena ASC')
      ->asArray()->all();
  }
}