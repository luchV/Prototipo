<?php

use common\models\Menus;
use common\models\Params;

$usu = Yii::$app->user->identity;
if (!is_null($usu)) {
  // Guardamos el menu si ya estamos logueados
  $menus = Menus::listarMenu(
    Params::ins_codigo,
    (int) Yii::$app->user->identity->usu_tipo
  );
  $MenusCargados = '';
  // Buscamos los menus para agregarlos
  foreach ($menus as $menu) {
    // Cast porque en session son guardados como array
    $menu = (object) $menu;
    $url = $menu->men_url;

    $MenusCargados .= '<a href="' . $url . '" title="' . $menu->men_nombre . '">
      <div class="option">
        <em class="' . $menu->men_icono . '"></em>
        <h4 id="letras">' . $menu->men_nombre . '</h4>
      </div>
    </a>';
  }
}

?>

<div class="menu__side" id="menu_side">
    <div class="color_fondo">
      <img style="width: 90%;" src=<?= Params::IMAGEN ?> alt="<?= Params::NOMBREPROGRAMA ?>">
    </div>

  <div class="options__menu">
    <?php if (!empty($MenusCargados)) : ?>
      <?= $MenusCargados; ?>
    <?php endif; ?>
  </div>
</div>