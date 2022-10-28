<?php

use common\helpers\FuncionesGenerales;
use common\models\User;
use yii\bootstrap4\ActiveForm;
use common\widgets\GuardarCambios;

$edadCalculada = "";
if ($model->edad != "") {
  $textoA = " años";
  $edadObtenida = FuncionesGenerales::calcularEdad($model->edad);
  if ($edadObtenida == 1) {
    $textoA = " año";
  }
  $edadCalculada = "Edad: " . $edadObtenida . $textoA;
}
?>

<?php $form = ActiveForm::begin(); ?>
<div class="usuarios-form">

  <h3 style="text-align: initial;font-weight: bold;">
    Datos personales
  </h3>
  <div class="row">
    <div class="col-md-6">
      <?= $form->field($model, 'nombre1')->textInput(["pattern" => "[A-Za-zñáéíóúÑÁÉÍÓÚ ]+", "title" => "Escribir solamente letras"]) ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'nombre2')->textInput(["pattern" => "[A-Za-zñáéíóúÑÁÉÍÓÚ ]+", "title" => "Escribir solamente letras"]) ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'apellido1')->textInput(["pattern" => "[A-Za-zñáéíóúÑÁÉÍÓÚ ]+", "title" => "Escribir solamente letras"]) ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'apellido2')->textInput(["pattern" => "[A-Za-zñáéíóúÑÁÉÍÓÚ ]+", "title" => "Escribir solamente letras"]) ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'edad')->textInput(["type" => "date", "min" => "1800-01-01", "max" => $fechaActual, "pattern" => "\d{4}-\d{2}-\d{2}"]) ?>
    </div>
    <div class="col-md-6">
      <br />
      <br />
      <label id="edadNumero"><?= $edadCalculada ?></label>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'cedula')->textInput(["minlength" => "10", "pattern" => "[0-9]+", "title" => "Escribir solamente numeros"]) ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'tipoDiscapacidad')->dropDownList(FuncionesGenerales::TiposDiscapacidades(), array());
      ?>
    </div>
    <div class="col-md-6">
      <button class="btn btn-success" onclick='MostrarDetalleUsuario();' type="button">Teléfonos</button>
      <?php if (isset(Yii::$app->view->params['modalTelefono'])) echo Yii::$app->view->params['modalTelefono']; ?>
    </div>
  </div>
  <hr>

  <h3 style="text-align: initial;font-weight: bold;">
    Datos educativos
  </h3>
  <div class="row">
    <div class="col-md-6">
      <?=
      $form->field($model, 'insCodigo')->dropDownList($institucionLista, array(
        'style' => 'float:left;',
      ));
      ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'tipoEscuela')->dropDownList(FuncionesGenerales::TiposEscuelas(), array());
      ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'nivelInstruccion')->dropDownList(FuncionesGenerales::TiposInstituciones(), array());
      ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'nivelEducacion')->dropDownList(FuncionesGenerales::TiposNivelEducacion(), array());
      ?>
    </div>
  </div>
  <hr>

  <h3 style="text-align: initial;font-weight: bold;">
    Datos de configuración
  </h3>
  <div class="row">
    <div class="col-md-6">
      <?= $form->field($model, 'rolCodigo')->dropDownList($rolesLista, array(
        'style' => 'float:left;',
      ));
      ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'estado')->dropDownList(FuncionesGenerales::TiposEstados(), array(
        'style' => 'float:left;',
      ));
      ?>
      <br />
      <br />
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'usuEncargado')->dropDownList(User::listarUsuarios($model->insCodigo, $model->rolCodigo)->listCompleto, array(
        'style' => 'float:left;',
      ));
      ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'correo') ?>
    </div>
    <?php if (isset($activado)) { ?>
      <div class="col-md-6">
        <label class="control-label">Cambiar de contraseña </label>
        <div class="form-group">
          <label class="switch switch-lg">
            <input type="checkbox" <?= $activado ?> name="activarContrasena" onclick="activarCampo(this)">
            <span></span>
          </label>
        </div>
      </div>
    <?php } ?>

    <div class="col-md-6" id="campoContrasena" <?= isset($activado) ? ($activado != "checked" ? 'style="display: none;"' : "") : "" ?>>
      <?= $form->field($model, 'contrasena')->textInput(["type" => "password"]) ?>
    </div>
  </div>
  <hr>

  <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"><?= $errorMensaje ?></div>

  <?= GuardarCambios::widget([
    'model' => $model,
  ]); ?>
</div>
<?php ActiveForm::end(); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  let combo = document.getElementById("user-usuencargado");
  let comboRoles = document.getElementById("user-rolcodigo");

  if (comboRoles.options[comboRoles.selectedIndex].text == "Super Administrador") {
    $("#user-usuencargado").empty().append('');
    let option = document.createElement("option");
    option.textContent = "Ninguno";
    option.value = "<?= $parametro ?>";
    combo.add(option);
    $("#error").hide();
    $("#error").text("");
  }

  if ("<?= $errorMensaje ?>" != '') {
    $("#error").show();
    $("#error").text("<?= $errorMensaje ?>");
  }

  var fechaActual = new Date();
  $("#user-edad").change(function() {
    texto = " años"
    let edad = edadUsuario(document.getElementById('user-edad').value);
    if (edad == 1) {
      texto = " año";
    }
    document.getElementById('edadNumero').innerHTML = "Edad: " + edad + texto;
  });

  $("#user-rolcodigo").change(function() {
    if (document.getElementById('user-inscodigo').value != "") {
      if (comboRoles.options[comboRoles.selectedIndex].text == "Super Administrador") {
        $("#user-usuencargado").empty().append('');
        let option = document.createElement("option");
        option.textContent = "Ninguno";
        option.value = "<?= $parametro ?>";
        combo.add(option);
        $("#error").hide();
        $("#error").text("");
      } else {
        consultarUsuarios();
      }
    } else {
      $("#error").show();
      $("#error").text("Por favor seleccione una Institución antes de seleccionar un Encargado.");
    }
  });

  $("#user-inscodigo").change(function() {
    $("#user-usuencargado").empty().append('');
  });

  function consultarUsuarios() {
    $("#user-usuencargado").empty().append('');
    $.get("index.php?r=usuarios/buscar-usuarios&idInstitucion=" + document.getElementById('user-inscodigo').value + "&rolSeleccionado=" + document.getElementById('user-rolcodigo').value, function(result, status, xhr) {
      if (status == "success") {
        let resultado = new Array(0);
        try {
          resultado = jQuery.parseJSON(result);
          if (resultado.correcto) {
            let select = document.getElementById("user-usuencargado");
            for (value in resultado.listCompleto) {
              let option = document.createElement("option");
              option.textContent = resultado.listCompleto[value];
              option.value = value;
              select.add(option);
            }
            $("#error").hide();
            $("#error").text("");
          } else {
            if (resultado.seleccionFaltante != 'Ninguno') {
              $("#error").show();
              $("#error").text("No se tiene (" + resultado.seleccionFaltante + ") para seleccionar en Encargado.");
            }
          }
        } catch (err) {
          $("#error").show();
          $("#error").text("Error al momento de obtener los encargados.");
        }
      }
    }).fail(function() {
      $("#error").show();
      $("#error").text("Error al momento de obtener los encargados.");
    });
  }

  function activarCampo($campo) {

    if ($campo.checked) {
      $('#campoContrasena').show();
    } else {
      $('#campoContrasena').hide();
    }
  }
</script>