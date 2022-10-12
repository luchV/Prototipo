<?php

use common\models\Modulos;
use common\models\TieneModulosUsuarios;
use common\models\Params;
use common\models\RelacionModulos;

$usu = Yii::$app->user->identity;
$actividades = '';
$reportes = '';
$administracion = '';
if (!is_null($usu)) {
  // Guardamos el menu si ya estamos logueados

  $tieneModulos = TieneModulosUsuarios::listarModulosUsuarios(
    Yii::$app->user->identity->usuCodigo
  );

  $menus = [];
  foreach ($tieneModulos as $value) {
    $relacioModulos = RelacionModulos::listarRelacionModulos(
      $value['relCodigo']
    );
    foreach ($relacioModulos as $relacion) {
      $menu = Modulos::listarModulos(
        $relacion['modCodigo']
      );
      array_push($menus, $menu[0]);
    }
  }

  $MenusCargados = '';
  // Buscamos los menus para agregarlos
  foreach ($menus as $menu) {
    // Cast porque en session son guardados como array
    $menu = (object) $menu;

    $MenusCargados = '<a href="' . $menu->modUrl . '" title="' . $menu->modNombre . '">
      <div class="option">
        <em class="' . $menu->modIcono . '"></em>
        <h4 class="tituloNombres" id="letras">' . $menu->modNombre . '</h4>
      </div>
    </a>';

    switch ($menu->modSeccion) {
      case Modulos::SECCION_ADMINISTRACION:
        $administracion .= $MenusCargados;
        break;

      case Modulos::SECCION_REPORTES:
        $reportes .= $MenusCargados;
        break;

      case Modulos::SECCION_ACTIVIDADES:
        $actividades .= $MenusCargados;
        break;
      default:
        # code...
        break;
    }
  }
}

?>

<div class="menu__side" id="menu_side">
  <div class="color_fondo">
    <img style="width: 90%;" src=<?= Params::IMAGEN ?> alt="<?= Params::NOMBREPROGRAMA ?>">
  </div>

  <div class="options__menu list-unstyled">
    <?php if (!empty($administracion)) : ?>
      <li class="tituloSecciones">
        <hr>
        <a class="dropdown-toggle" style="text-decoration: none;">Administración</a>
        <hr>
      </li>
      <?= $administracion; ?>
    <?php endif; ?>
    <?php if (!empty($reportes)) : ?>
      <li class="tituloSecciones">
        <hr>
        <a class="dropdown-toggle" style="text-decoration: none;">Reportes</a>
        <hr>
      </li>
      <?= $reportes; ?>
    <?php endif; ?>
    <?php if (!empty($actividades)) : ?>
      <li class="tituloSecciones">
        <hr>
        <a class="dropdown-toggle" style="text-decoration: none;">Actividades</a>
        <hr>
      </li>
      <?= $actividades; ?>
    <?php endif; ?>
  </div>
</div>