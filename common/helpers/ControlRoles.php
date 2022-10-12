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
    $acceso = Accesos::listarAccesos($tipoRol);
    $rolesAcessos = TieneRolesAccesos::listarRolesAccesos($acceso['0']['accCodigo']);
    $arrayRoles = [];
    foreach ($rolesAcessos as  $accesoRol) {

      array_push($arrayRoles, $accesoRol['nombreAcceso']);
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
      exit();
    }
  }
}
