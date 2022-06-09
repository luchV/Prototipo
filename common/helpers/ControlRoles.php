<?php

namespace common\helpers;

use Yii;
use common\models\User;
use common\models\Params;
use common\models\RolesMenus;

class ControlRoles
{

  static function Roles($tipoRol)
  {

    $numeroRol = (int) Yii::$app->user->identity->usu_tipo;
    $query = RolesMenus::find()->where([
      'ins_codigo' => Params::ins_codigo,
      'role_numero' => (string)$numeroRol,
    ]);

    $rolesMenu = $query->asArray()->all();

    if (isset($rolesMenu[0]['role_accesos'][$tipoRol])) {
      $acciones = $rolesMenu[0]['role_accesos'][$tipoRol];
      $respuesta = [
        'actions' => $acciones,
        'allow' => true,
        'roles' => ['@'],
        'matchCallback' => function ($rule, $action) {
          $validacion = [(int) Yii::$app->user->identity->usu_tipo];
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
