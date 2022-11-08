<?php

use common\helpers\FuncionesGenerales;
use yii\bootstrap4\ActiveForm;
use common\widgets\GuardarCambios;
use common\widgets\ContenedorTablas;

?>


<?php $form = ActiveForm::begin(); ?>
<div class="configuracion-form">
    <h3 style="text-align: initial;font-weight: bold;">
        Módulo de actividad
    </h3>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'secNumeroPregunta')->textInput(['value' => ('Actividad ' . ($totalPreguntas)), 'disabled' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'secTipoRespuesta')->dropDownList(FuncionesGenerales::TiposPreguntas(), array()); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'secEstado')->dropDownList(FuncionesGenerales::TiposEstados(), array()); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'secPregunta') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'seccAudioPregunta') ?>

        </div>
        <h6>*El ID solicitando es de Google drive en donde está ubicado el audio, ejemplo: <a href="https://drive.google.com/file/d/1bSv29qAfeWbyXkxhXprex1vgUUWW1xb9/preview">1bSv29qAfeWbyXkxhXprex1vgUUWW1xb9</a></h6>
        <div class="col-md-12">
            <?= $form->field($model, 'seccSubpregunta') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'seccAudioSubPregunta') ?>
        </div>
        <h6>*El ID solicitando es de Google drive en donde está ubicado el audio, ejemplo: <a href="https://drive.google.com/file/d/1bSv29qAfeWbyXkxhXprex1vgUUWW1xb9/preview">1bSv29qAfeWbyXkxhXprex1vgUUWW1xb9</a></h6>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label class="control-label">Orden adicional </label>
            <div class="form-group">
                <label class="switch switch-lg">
                    <input type="checkbox" <?= $activado ?? "" ?> name="activarPreguntaAdicional" onclick="activarCampoPreguntas(this)">
                    <span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="row" id="campoPreguntaAdicional" <?= isset($activado) ? ($activado != "checked" ? 'style="display: none;"' : "") : 'style="display: none;"' ?>>
        <div class="col-md-12">
            <?= $form->field($model, 'seccPreguntaAdicional') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'seccAudioPreguntaAdicional') ?>
        </div>
        <h6>*El ID solicitando es de Google drive en donde está ubicado el audio, ejemplo: <a href="https://drive.google.com/file/d/1bSv29qAfeWbyXkxhXprex1vgUUWW1xb9/preview">1bSv29qAfeWbyXkxhXprex1vgUUWW1xb9</a></h6>
    </div>
    <hr>

    <h3 style="text-align: initial;font-weight: bold;">
        Módulo de respuestas
    </h3>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($modelRespuestas, 'resNumero')->textInput(['value' => ('Respuesta ' . ($totalRespuestas + 1)), 'disabled' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($modelRespuestas, 'respuestaCorrecto')->dropDownList(FuncionesGenerales::TiposRespuestas(), array()); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= $form->field($modelRespuestas, 'imagen') ?>
            </div>
        </div>
        <h6>*El ID solicitando es de Google drive en donde está ubicado la imagen, ejemplo: <a href="https://drive.google.com/uc?export=view&id=13vyXYYOSaL5EsHCG4lagkWefBqJ1VV4s">13vyXYYOSaL5EsHCG4lagkWefBqJ1VV4s</a></h6>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($modelRespuestas, 'respuestaTexto') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            </br>
            <button class="btn btn-primary" onclick="agregarRespuesta();" type="button">Agregar respuesta</button>
        </div>
    </div>
    </br>
    <div class="alert alert-danger" name='error' id="error" role="alert" style="display: none;"><?= $errorMensaje ?></div>
    </br>
    <div style="color:#dc3545;font-size:80%" id="errorRespuestas"></div>
    <?php ContenedorTablas::begin();  ?>
    <table aria-describedby="mydesc1" class="table table-hover" id="tablaRespuestas" name="tablaRespuestas">
        <thead>
            <tr>
                <th scope="col">Respuesta N.</th>
                <th scope="col">Tipo de respuesta</th>
                <th scope="col">Respuesta Texto</th>
                <th scope="col">Imagen de respuesta</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($modelRespuestaMuestra)) {
                $index = 1;
                foreach ($modelRespuestaMuestra as $value) {
                    $dato = $value['resNumero'] . '&' . $value['respuestaCorrecto'] . '&' . $value['respuestaTexto'] . '&' . $value['imagen'];
                    echo '<tr id="filaRespuesta ' . $value['resNumero'] . '">
                                    <td>' . 'Respuesta ' . $value['resNumero'] . '<input type="hidden" name="elementosRespuestas[]" value="' . $dato . '"></td>
                                    <td>' . $value['respuestaCorrecto'] . '</td>
                                    <td>' . $value['respuestaTexto'] . '</td>
                                    <td>' . $value['imagen'] . '</td>
                                    <td><button  class="btn btn-danger" onclick="quietarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Eliminar</button></td>
                                </tr>';
                    $index++;
                }
            }
            ?>
        </tbody>
    </table>
    <?php ContenedorTablas::end();  ?>

    <hr>
    <?= GuardarCambios::widget([
        'model' => $model,
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    if ("<?= $errorMensaje ?>" != '') {
        $("#error").show();
        $("#error").text("<?= $errorMensaje ?>");
    }

    function activarCampoPreguntas($campo) {
        if ($campo.checked) {
            $('#campoPreguntaAdicional').show();
        } else {
            $('#campoPreguntaAdicional').hide();
        }
    }

    function agregarRespuesta() {
        if ($('#respuestas-resnumero').val().trim() != "" && $('#respuestas-respuestacorrecto').val().trim() != "" && $('#respuestas-respuestatexto').val().trim() != "" && $('#respuestas-imagen').val().trim() != "") {
            $("#errorRespuestas").html('');
            let table = document.getElementById("tablaRespuestas");
            let row = table.insertRow(table.rows.length);

            row.id = "fila" + $('#respuestas-resnumero').val();

            let celda1 = row.insertCell(0);
            let celda2 = row.insertCell(1);
            let celda3 = row.insertCell(2);
            let celda4 = row.insertCell(3);
            let celda5 = row.insertCell(4);
            let tablaDatos = $('#respuestas-resnumero').val() + '&' + $('#respuestas-respuestacorrecto').val() + '&' + $('#respuestas-respuestatexto').val() + '&' + $('#respuestas-imagen').val();
            celda1.innerHTML = $('#respuestas-resnumero').val() + '<input type="hidden"s name="elementosRespuestas[]" value="' + tablaDatos + '">';
            celda2.innerHTML = $('#respuestas-respuestacorrecto').val();
            celda3.innerHTML = $('#respuestas-respuestatexto').val();
            celda4.innerHTML = $('#respuestas-imagen').val();
            celda5.innerHTML = '<button  class="btn btn-danger" onclick="quietarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Eliminar</button>';

            let numeroRespuesta = $('#respuestas-resnumero').val().trim().split(' ');
            let numeroSiguiente = numeroRespuesta[0] + " " + (parseInt(numeroRespuesta[1]) + 1);
            $('#respuestas-resnumero').val(numeroSiguiente);
            $('#respuestas-respuestacorrecto').val('');
            $('#respuestas-respuestatexto').val('');
            $('#respuestas-imagen').val('');
        } else {
            $("#errorRespuestas").html('Para ingresar una respuesta se debe llegar todos los campos.');
        }
    }

    function quietarElemento(id) {
        let row = document.getElementById(id);
        row.parentNode.removeChild(row);
        if ($('#elementosRespuestas').val() === undefined) {}
    }
</script>