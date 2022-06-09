<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "RolesMenus".
 *
 * @property \MongoId|string $_id
 * @property mixed $role_nombre
 * @property mixed $role_numero
 * @property mixed $ins_codigo
 * @property mixed $role_accesos
 */
class RolesMenus extends \yii\mongodb\ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function collectionName()
  {
    $bd = validarBase();

    return [$bd, 'rolesMenus'];
  }

  /**
   * @inheritdoc
   */
  public function attributes()
  {
    return [
      '_id',
      'role_nombre',
      'role_numero',
      'ins_codigo',
      'role_accesos',
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['role_nombre', 'role_numero', 'ins_codigo', 'role_accesos'], 'safe']
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

}
