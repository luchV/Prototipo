<?php

use common\models\Institucion;
use common\models\Roles;
use common\models\User;
use common\widgets\ContenedorTablas;
use yii\bootstrap4\Html;
use yii\grid\GridView;

?>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#usuariosModal" id="detallesUModal" style="display: none;">Open Modal</button>
<div class="modal fade" id="usuariosModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Seleccionar un <?= $Texto ?></h5>
      </div>
      <div class="modal-body">
        <?php ContenedorTablas::begin();  ?>
        <?php
        $gridView = [
          'dataProvider' => $dataProvider,
          'filterModel' => $modalUsuario,
          'summary' => 'Mostrando {begin} - {end} de {totalCount} ' . $Texto . 's.',
          'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'format' => 'raw',
              'value' => function ($model) {
                return '<button class="btn btn-primary fa fa-search" onclick=seleccionarUsuario("' . $model->cedula . '"); type="button"></button>';
              },
            ],
            [
              'label' => 'Nombre usuario',
              'value' => function ($model) {
                return $model->nombre1 . ' ' . $model->apellido1;
              },
            ],
            [
              'label' => 'Cedula usuario',
              'value' => function ($model) {
                return $model->cedula;
              },
            ],
          ],
        ];

        if ($rolActivo == '2') {
          $acciones =
            [
              'label' => 'Institución',
              'value' => function ($model) {
                return Institucion::listarInstituciones()[$model->insCodigo];
              },
            ];
          array_push($gridView['columns'], $acciones);
        }

        if ($rolActivo == '2' || ($rolActivo == '3' && $estudiante)) {
          $acciones =
            [
              'label' => 'Encargado',
              'value' => function ($model) {
                $usuarioBusqueda = User::findIdentity($model->usuEncargado);
                return $usuarioBusqueda['nombre1'] . ' ' . $usuarioBusqueda['apellido1'];
              },
            ];
          array_push($gridView['columns'], $acciones);
        }

        ?>
        <?= GridView::widget($gridView) ?>
        <?php ContenedorTablas::end();  ?>

      </div>
      <div class="modal-footer">
        <button type="button" id='botonCerrar' class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  function MostrarDetalleUsuario() {
    let objO = document.getElementById('detallesUModal');
    objO.click();
  }

  function seleccionarUsuario(cedulaU) {
    $('#cedulaUsuario').val(cedulaU);
    let objO = document.getElementById('botonCerrar');
    objO.click();
  }
</script>