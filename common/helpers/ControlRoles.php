<?php

namespace common\helpers;

use common\models\Accesos;
use Yii;
use common\models\User;
use common\models\TieneRolesAccesos;

class ControlRoles
{

  static function Roles($tipoRol)
  {
    $redireccion = "Location: " . 'index.php';
    if (!isset(Yii::$app->user->identity->rolCodigo)) {
      Yii::$app->session->setFlash('error', "Acceso denegado");
      header($redireccion);
      exit();
    }
    $acceso = Accesos::listarAccesos($tipoRol);
    if (count($acceso) > 0) {
      $rolesAcessos = TieneRolesAccesos::listarRolesAccesos($acceso['0']['accCodigo']);
      $arrayRoles = [];
      foreach ($rolesAcessos as  $accesoRol) {
        if ($accesoRol['rolCodigo'] == Yii::$app->user->identity->rolCodigo) {
          array_push($arrayRoles, $accesoRol['nombreAcceso']);
        }
      }
      if (count($arrayRoles) == 0) {
        $arrayRoles = [''];
      }
      if (isset($arrayRoles)) {
        $acciones = $arrayRoles;
        $respuesta = [
          'actions' => $acciones,
          'allow' => true,
          'roles' => ['@'],
          'matchCallback' => function ($rule, $action) {
            $validacion = [(int) Yii::$app->user->identity->rolCodigo];
            return User::roleInArray($validacion) && User::isActive();
          },
        ];
        return $respuesta;
      } else {
        Yii::$app->session->setFlash('error', "Acceso denegado");
        header($redireccion);
        exit();
      }
    } else {
      Yii::$app->session->setFlash('error', "Acceso denegado");
      header($redireccion);
      exit();
    }
  }
}
