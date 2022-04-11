<?php
function validarBase()
{
  $bd = 'prototipo';
  if (!YII_DEBUG) {
    $bd = 'prototipo';
  }
  return $bd;
}
