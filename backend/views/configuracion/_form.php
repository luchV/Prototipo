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
        <div class="col-md-12">
            <?= $form->field($model, 'seccSubpregunta') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'seccAudioSubPregunta') ?>
        </div>
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
        <?php if (($totalPreguntas == 3 || $totalPreguntas == 5) && $modelID->modNombre == 'Sonidos iniciales') { ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($modelRespuestas, 'respuestaCorrectoEspecial')->dropDownList(FuncionesGenerales::TiposRespuestas(), array()); ?>
                </div>
            </div>
        <?php } ?>
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
                <?php if (($totalPreguntas == 3 || $totalPreguntas == 5) && $modelID->modNombre == 'Sonidos iniciales') { ?>
                    <th scope="col">Tipo de respuesta para seleccionar primero</th>
                <?php } ?>
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
                if (($totalPreguntas == 3 || $totalPreguntas == 5) && $modelID->modNombre == 'Sonidos iniciales') {
                    foreach ($modelRespuestaMuestra as $value) {
                        $dato = $value['resNumero'] . '&' . $value['respuestaCorrectoEspecial'] . '&' . $value['respuestaCorrecto'] . '&' . $value['respuestaTexto'] . '&' . $value['imagen'];
                        echo '<tr id="filaRespuesta ' . $value['resNumero'] . '">
                                        <td>' . 'Respuesta ' . $value['resNumero'] . '<input type="hidden" id="inputRespuesta' . $value['resNumero'] . '" name="elementosRespuestas[]" value="' . $dato . '"></td>
                                        <td id="colEspe' . $value['resNumero'] . '">' . $value['respuestaCorrectoEspecial'] . '</td>
                                        <td id="colC' . $value['resNumero'] . '">' . $value['respuestaCorrecto'] . '</td>
                                        <td id="colR' . $value['resNumero'] . '">' . $value['respuestaTexto'] . '</td>
                                        <td id="colL' . $value['resNumero'] . '">' . FuncionesGenerales::ponerEnlace($value['imagen']) . '</td>
                                        <td id="colEl' . $value['resNumero'] . '"><button class="btn btn-danger" onclick="quietarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Eliminar</button></td>
                                        <td id="colAc' . $value['resNumero'] . '"><button class="btn btn-primary" onclick="editarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Editar</button></td>
                                        <td id="colGuard' . $value['resNumero'] . '" style="display:none;"><button class="btn btn-success" onclick="guardarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Guardar</button></td>
                                    </tr>';
                        $index++;
                    }
                } else {
                    foreach ($modelRespuestaMuestra as $value) {
                        $dato = $value['resNumero'] . '&' . $value['respuestaCorrecto'] . '&' . $value['respuestaTexto'] . '&' . $value['imagen'];
                        echo '<tr id="filaRespuesta ' . $value['resNumero'] . '">
                                                <td>' . 'Respuesta ' . $value['resNumero'] . '<input type="hidden" id="inputRespuesta' . $value['resNumero'] . '" name="elementosRespuestas[]" value="' . $dato . '"></td>
                                                <td id="colC' . $value['resNumero'] . '">' . $value['respuestaCorrecto'] . '</td>
                                                <td id="colR' . $value['resNumero'] . '">' . $value['respuestaTexto'] . '</td>
                                                <td id="colL' . $value['resNumero'] . '">' . FuncionesGenerales::ponerEnlace($value['imagen']) . '</td>
                                                <td id="colEl' . $value['resNumero'] . '"><button class="btn btn-danger" onclick="quietarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Eliminar</button></td>
                                                <td id="colAc' . $value['resNumero'] . '"><button class="btn btn-primary" onclick="editarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Editar</button></td>
                                                <td id="colGuard' . $value['resNumero'] . '" style="display:none;"><button class="btn btn-success" onclick="guardarElemento(' . "'filaRespuesta " . $value['resNumero'] . "'" . ');" type="button">Guardar</button></td>
                                            </tr>';
                        $index++;
                    }
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
            let numeroPreungta = '<?= $totalPreguntas  ?>';
            let nombrePregunta = '<?= $modelID->modNombre ?>';
            if ((numeroPreungta == '3' || numeroPreungta == '5') && nombrePregunta == 'Sonidos iniciales') {
                if ($('#respuestas-respuestacorrectoespecial').val().trim() == "") {
                    $("#errorRespuestas").html('Para ingresar una respuesta se debe llegar todos los campos.');
                    return false;
                }
                let celda1 = row.insertCell(0);
                let celda2 = row.insertCell(1);
                let celda3 = row.insertCell(2);
                let celda4 = row.insertCell(3);
                let celda5 = row.insertCell(4);
                let celda6 = row.insertCell(5);
                let celda7 = row.insertCell(6);
                let celda8 = row.insertCell(7);
                let tablaDatos = $('#respuestas-resnumero').val() + '&' + $('#respuestas-respuestacorrectoespecial').val() + '&' + $('#respuestas-respuestacorrecto').val() + '&' + $('#respuestas-respuestatexto').val() + '&' + $('#respuestas-imagen').val();
                celda1.innerHTML = $('#respuestas-resnumero').val() + '<input type="hidden" id="inputRespuesta' + (table.rows.length - 1) + '" name="elementosRespuestas[]" value="' + tablaDatos + '">';
                celda2.id = 'colEspe' + (table.rows.length - 1);
                celda2.innerHTML = $('#respuestas-respuestacorrectoespecial').val();
                celda3.id = 'colC' + (table.rows.length - 1);
                celda3.innerHTML = $('#respuestas-respuestacorrecto').val();
                celda4.id = 'colR' + (table.rows.length - 1);
                celda4.innerHTML = $('#respuestas-respuestatexto').val();
                celda5.id = 'colL' + (table.rows.length - 1);
                celda5.innerHTML = $('#respuestas-imagen').val();
                celda6.id = 'colEl' + (table.rows.length - 1);
                celda6.innerHTML = '<button class="btn btn-danger" onclick="quietarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Eliminar</button>';
                celda7.id = 'colAc' + (table.rows.length - 1);
                celda7.innerHTML = '<button class="btn btn-primary" onclick="editarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Editar</button>';
                celda8.id = 'colGuard' + (table.rows.length - 1);
                celda8.style = 'display:none;';
                celda8.innerHTML = '<button class="btn btn-success" onclick="guardarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Guardar</button>';
                let numeroRespuesta = $('#respuestas-resnumero').val().trim().split(' ');
                let numeroSiguiente = numeroRespuesta[0] + " " + (parseInt(numeroRespuesta[1]) + 1);
                $('#respuestas-resnumero').val(numeroSiguiente);
                $('#respuestas-respuestacorrectoespecial').val('');
                $('#respuestas-respuestacorrecto').val('');
                $('#respuestas-respuestatexto').val('');
                $('#respuestas-imagen').val('');
            } else {
                let celda1 = row.insertCell(0);
                let celda2 = row.insertCell(1);
                let celda3 = row.insertCell(2);
                let celda4 = row.insertCell(3);
                let celda5 = row.insertCell(4);
                let celda6 = row.insertCell(5);
                let celda7 = row.insertCell(6);
                let tablaDatos = $('#respuestas-resnumero').val() + '&' + $('#respuestas-respuestacorrecto').val() + '&' + $('#respuestas-respuestatexto').val() + '&' + $('#respuestas-imagen').val();
                celda1.innerHTML = $('#respuestas-resnumero').val() + '<input type="hidden" id="inputRespuesta' + (table.rows.length - 1) + '" name="elementosRespuestas[]" value="' + tablaDatos + '">';
                celda2.id = 'colC' + (table.rows.length - 1);
                celda2.innerHTML = $('#respuestas-respuestacorrecto').val();
                celda3.id = 'colR' + (table.rows.length - 1);
                celda3.innerHTML = $('#respuestas-respuestatexto').val();
                celda4.id = 'colL' + (table.rows.length - 1);
                celda4.innerHTML = $('#respuestas-imagen').val();
                celda5.id = 'colEl' + (table.rows.length - 1);
                celda5.innerHTML = '<button class="btn btn-danger" onclick="quietarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Eliminar</button>';
                celda6.id = 'colAc' + (table.rows.length - 1);
                celda6.innerHTML = '<button class="btn btn-primary" onclick="editarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Editar</button>';
                celda7.id = 'colGuard' + (table.rows.length - 1);
                celda7.style = 'display:none;';
                celda7.innerHTML = '<button class="btn btn-success" onclick="guardarElemento(' + "'fila" + $('#respuestas-resnumero').val() + "'" + ');" type="button">Guardar</button>';
                let numeroRespuesta = $('#respuestas-resnumero').val().trim().split(' ');
                let numeroSiguiente = numeroRespuesta[0] + " " + (parseInt(numeroRespuesta[1]) + 1);
                $('#respuestas-resnumero').val(numeroSiguiente);
                $('#respuestas-respuestacorrecto').val('');
                $('#respuestas-respuestatexto').val('');
                $('#respuestas-imagen').val('');
            }
        } else {
            $("#errorRespuestas").html('Para ingresar una respuesta se debe llegar todos los campos.');
        }
    }

    function quietarElemento(id) {
        let row = document.getElementById(id);
        row.parentNode.removeChild(row);
        if ($('#elementosRespuestas').val() === undefined) {}
    }

    function guardarElemento(id) {
        let indexArray = id.split(' ');
        let index = indexArray[1];

        $('#error').text('');
        $('#error').hide();
        let selecRespuestaBol = document.getElementById("selectRespuestaB" + index);
        let imputRespuestaTexto = document.getElementById("imputRespuestaTex" + index).value.trim();
        let imputRespuestaLinkR = document.getElementById("imputRespuestaLink" + index).value.trim();
        let imputRespuesta = document.getElementById("inputRespuesta" + index);
        let colRespuestaB = document.getElementById("colC" + index);
        let colRespuestaTex = document.getElementById("colR" + index);
        let colRespuestaLink = document.getElementById("colL" + index);

        let numeroPreungta = '<?= $totalPreguntas ?>';
        let nombrePregunta = '<?= $modelID->modNombre ?>';
        if ((numeroPreungta == '3' || numeroPreungta == '5') && nombrePregunta == 'Sonidos iniciales') {
            var colRespuestaEspecial = document.getElementById("colEspe" + index);
            var selecRespuestaEspecial = document.getElementById("selectRespuestaEspecial" + index);
            if (selecRespuestaEspecial.value != 'true' && selecRespuestaEspecial.value != 'false') {
                $('#error').text('Seleccionar un tipo de respuesta para seleccionar primero');
                $('#error').show();
                return false;
            }
        }
        if (selecRespuestaBol.value != 'true' && selecRespuestaBol.value != 'false') {
            $('#error').text('Seleccionar un tipo de respuesta');
            $('#error').show();
        } else if (imputRespuestaTexto.length == 0) {
            $('#error').text('Escribir una respuesta de Texto');
            $('#error').show();
        } else if (imputRespuestaLinkR.length == 0) {
            $('#error').text('Escribir una imagen de respuesta');
            $('#error').show();
        } else {
            if ((numeroPreungta == '3' || numeroPreungta == '5') && nombrePregunta == 'Sonidos iniciales') {
                $("#inputRespuesta" + index).val(index + '&' + selecRespuestaEspecial.value + '&' + selecRespuestaBol.value + '&' + imputRespuestaTexto + '&' + imputRespuestaLinkR);
                colRespuestaEspecial.innerHTML = selecRespuestaEspecial.value;
            } else {
                $("#inputRespuesta" + index).val(index + '&' + selecRespuestaBol.value + '&' + imputRespuestaTexto + '&' + imputRespuestaLinkR);
            }
            $('#colEl' + index).show();
            $('#colAc' + index).show();
            $('#colGuard' + index).hide();
            colRespuestaB.innerHTML = selecRespuestaBol.value;
            colRespuestaTex.innerHTML = imputRespuestaTexto;
            colRespuestaLink.innerHTML = imputRespuestaLinkR;
        }
    }

    function editarElemento(id) {
        let indexArray = id.split(' ');
        let index = indexArray[1];

        let colRespuestaB = document.getElementById("colC" + index);
        let colRespuestaTex = document.getElementById("colR" + index);
        let colRespuestaLink = document.getElementById("colL" + index);


        let select = document.createElement("select");
        let option = document.createElement('option');
        select.id = "selectRespuestaB" + index;
        select.className = "form-control";
        option.value = '';
        option.text = 'Seleccionar';
        select.appendChild(option);
        let option2 = document.createElement('option');
        option2.value = 'true';
        option2.text = 'Correcta';
        if (colRespuestaB.innerHTML == 'true') {
            option2.selected = true;
        }
        select.appendChild(option2);
        let option3 = document.createElement('option');
        option3.value = 'false';
        option3.text = 'Incorrecta';
        if (colRespuestaB.innerHTML == 'false') {
            option3.selected = true;
        }
        select.appendChild(option3);

        colRespuestaB.innerHTML = '';

        colRespuestaB.appendChild(select);
        colRespuestaTex.innerHTML = '<input class="form-control" type="text" id="imputRespuestaTex' + index + '" value="' + colRespuestaTex.innerHTML + '">';
        colRespuestaLink.innerHTML = '<input class="form-control" type="text" id="imputRespuestaLink' + index + '" value="' + colRespuestaLink.innerHTML + '">';

        let numeroPreungta = '<?= $totalPreguntas  ?>';
        let nombrePregunta = '<?= $modelID->modNombre ?>';
        if ((numeroPreungta == '3' || numeroPreungta == '5') && nombrePregunta == 'Sonidos iniciales') {
            let colRespuestaEspe = document.getElementById("colEspe" + index);
            select = document.createElement("select");
            option = document.createElement('option');
            select.id = "selectRespuestaEspecial" + index;
            select.className = "form-control";
            option.value = '';
            option.text = 'Seleccionar';
            select.appendChild(option);
            option2 = document.createElement('option');
            option2.value = 'true';
            option2.text = 'Correcta';
            if (colRespuestaEspe.innerHTML == 'true') {
                option2.selected = true;
            }
            select.appendChild(option2);
            option3 = document.createElement('option');
            option3.value = 'false';
            option3.text = 'Incorrecta';
            if (colRespuestaEspe.innerHTML == 'false') {
                option3.selected = true;
            }
            select.appendChild(option3);
            colRespuestaEspe.innerHTML = '';
            colRespuestaEspe.appendChild(select);
        }
        $('#colEl' + index).hide();
        $('#colAc' + index).hide();
        $('#colGuard' + index).show();
    }
</script>