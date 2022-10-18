<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
  public static function BusquedaRol(
    string $rolCodigo
  ): array {
    return Roles::find()
      ->where([
        'rolCodigo' => $rolCodigo,
      ])->asArray()->all();
  }

  public static function listarRoles()
  {

    $list = ArrayHelper::map(Roles::find()->all(), function ($model_aux) {
      return (string)$model_aux->rolCodigo;
    }, 'rolNombre');
    $Opcion1 = array(null => "Seleccionar");
    $listCompleto = $Opcion1 + $list;

    return  $listCompleto;
  }

  public static function listarRolesFiltro()
  {

    $list = ArrayHelper::map(Roles::find()->all(), function ($model_aux) {
      return (string)$model_aux->rolCodigo;
    }, 'rolNombre');
    $Opcion1 = array(null => "Todos");
    $listCompleto = $Opcion1 + $list;

    return  $listCompleto;
  }

  public static function indiceRol($arrayBuscar, $valorBuscar)
  {
    $parametro = "";
    foreach ($arrayBuscar as $indice => $valor) {
      if ($valor == $valorBuscar) {
        $parametro = $indice;
        break;
      }
    }
    return  $parametro;
  }

  public static function detectarRoles($rolCodigoUsuario)
  {
    $listaRoles = [];
    if (strlen($rolCodigoUsuario) == 1) {
      $rolUsuario = $rolCodigoUsuario;
      $listaRoles = self::listarRolesFiltro();
    } else {
      $rolUsuario = self::BusquedaRol($rolCodigoUsuario)[0]['rolNumero'];
      $listaRoles = self::listarRoles();
    }
    switch ($rolUsuario) {
      case '3':
        $datoEliminar = self::indiceRol($listaRoles, 'Super Administrador');
        unset($listaRoles[$datoEliminar]);
        $datoEliminar = self::indiceRol($listaRoles, 'Administrador');
        unset($listaRoles[$datoEliminar]);
        break;
      case '4':
        $datoEliminar = self::indiceRol($listaRoles, 'Super Administrador');
        unset($listaRoles[$datoEliminar]);
        $datoEliminar = self::indiceRol($listaRoles, 'Administrador');
        unset($listaRoles[$datoEliminar]);
        $datoEliminar = self::indiceRol($listaRoles, 'Profesor');
        unset($listaRoles[$datoEliminar]);
        break;
    }
    return $listaRoles;
  }
}
