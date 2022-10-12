<?php
function validarBase()
{
  $bd = 'tesisfonoaudiologia';
  if (!YII_DEBUG) {
    $bd = 'tesisfonoaudiologia';
  }
  return $bd;
}
