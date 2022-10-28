<?php

use common\widgets\ContenedorTablas;
?>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#telefonoModal" id="detallesModal" style="display: none;">Open Modal</button>
<div class="modal fade" id="telefonoModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Teléfonos del usuario</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label class="control-label">Teléfono</label>
              <input type="number" id="telefono" class="form-control" name="telefono" />
            </div>
          </div>
          <div class="col-md-2">
            </br>
            <button class="btn btn-success" onclick="agregarTelefono();" type="button">Agregar</button>
          </div>
        </div>
        <?php ContenedorTablas::begin();  ?>
        <table aria-describedby="Descripción" class="table table-hover" id="telefonosTabla" name="telefonosTabla">
          <thead>
            <tr>
              <th scope="col">Teléfono</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($modelTelefono)) {
              foreach ($modelTelefono as $datosTelefono) {
                if (isset($datosTelefono['NumeroTelf'])) {
                  $dato = $datosTelefono['NumeroTelf'];
                } else {
                  $dato = $datosTelefono;
                }
                echo '<tr id="fila' . $dato . '">
                                <td>' . $dato . '<input type="hidden" name="tablaDatos[]" value="' . $dato . '"></td>
                                <td><button  class="btn btn-danger" onclick="quitarTelefono(' . "'fila" . $dato . "'" . ');" type="button">Eliminar</button></td>
                            </tr>';
              }
            }
            ?>
          </tbody>
        </table>
        <div class="alert alert-danger" name='errorTelefono' id="errorTelefono" role="alert" style="display: none;"></div>
        <?php ContenedorTablas::end();  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  function MostrarDetalleUsuario() {
    var objO = document.getElementById('detallesModal');
    objO.click();
  }

  function agregarTelefono() {
    if ($('#telefono').val().trim() != "" && $('#telefono').val().trim().length >= 7) {
      $("#errorTelefono").html('');
      $("#errorTelefono").hide();
      let table = document.getElementById("telefonosTabla");
      let row = table.insertRow(table.rows.length);

      row.id = "fila" + $('#telefono').val();

      let celda = row.insertCell(0);
      let celda2 = row.insertCell(1);
      let tablaDatos = $('#telefono').val();
      celda.innerHTML = $('#telefono').val() + '<input type="hidden"s name="tablaDatos[]" value="' + tablaDatos + '">';
      celda2.innerHTML = '<button  class="btn btn-danger" onclick="quitarTelefono(' + "'fila" + $('#telefono').val() + "'" + ');" type="button">Eliminar</button>';
      $('#telefono').val('');
    } else {
      $("#errorTelefono").html('El numero telefonico debe ser mayor a 7 digitos.');
      $("#errorTelefono").show();
    }
  }

  function quitarTelefono(id) {
    var row = document.getElementById(id);
    row.parentNode.removeChild(row);
    if ($('#tablaDatos').val() === undefined) {}
  }
</script>