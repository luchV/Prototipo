<?php

/**
 * @var $this yii\web\View
 * @var string $fechaSeleccionada - Raango con formato d-m-Y | d-m-Y
 * @var string $idFecha
 * @var string $nameFecha
 */
?>
<div class="row">
  <div class="col-md-6">
    <label for="<?= $idFecha ?>">Rango de Fechas:</label>
  </div>
</div>
<div id="Campofecha" class="form-group col-lg-4 col-sm-5 col-12" style="padding-left: 0px;text-align: initial;">
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">
        <em class="fa fa-calendar"></em>
      </div>
    </div>
    <input type="text" class="form-control" id="<?= $idFecha ?>" name="<?= $nameFecha ?>" value="<?= $fechaSeleccionada ?>">
  </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
  var fechaSeleccionada = $("#<?= $idFecha ?>").val();
  var fecha = new Date();
  var fechaMaximo = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();

  if (fechaSeleccionada) {
    var datos = fechaSeleccionada.split(" / ");

    var fechaInicio = datos[0];
    var fechaFin = datos[1];

    $("#<?= $idFecha ?>").daterangepicker({
      "locale": {
        "format": "YYYY-MM-DD",
        "separator": " / ",
        "applyLabel": "Aceptar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizar",
        "daysOfWeek": [
          "Do",
          "Lu",
          "Ma",
          "Mi",
          "Ju",
          "Vi",
          "Sa"
        ],
        "monthNames": [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Setiembre",
          "Octubre",
          "Noviembre",
          "Diciembre"
        ],
        "firstDay": 1,
      },
      "startDate": fechaInicio,
      "endDate": fechaFin,
      'minDate': '2022-01-01',
      'maxDate': fechaMaximo,
      "maxSpan": {
        "month": 1
      },
      "opens": "center",
      "showDropdowns": true,
    });
  }
</script>