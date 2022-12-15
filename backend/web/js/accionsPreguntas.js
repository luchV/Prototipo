function cambiarPregunta(controler, accion, tipoRespuesta, opcional = "") {
    var respuestas = new Array(0);
    let respuestaTexto = '';
    let contador = 0;
    if ((tipoRespuesta == 'voz' || (tipoRespuesta == 'ambos' && document.getElementById("checkAvanzado").checked)) && opcional != "") {
        respuestaTexto = document.getElementById('texto').innerHTML.trim();
        respuestas = respuestaTexto.split(' ');
    } else {
        let respuestasAux = new Array(0);
        let cont = document.getElementById('cantidadOpcionesRespuesta').value;
        for (let i = 0; i < cont; i++) {
            if (document.getElementById('capRes' + i).checked) {
                let valor = document.getElementById('capRes' + i).value.split(' ');
                respuestasAux[valor[(valor.length - 1)]] = valor[0];
                contador++;
            }
        }
        contador = 0;
        respuestasAux.forEach(function (item) {
            respuestas[contador] = item;
            contador++;
        });
    }
    if (respuestaTexto == '' && contador == 0) {
        respuestas = [0];
    }
    let data = {
        respuestas: respuestas,
        codigoS: $('#codigoPregunta').val(),
    }
    $.post("index.php?r=" + controler + "/" + accion, data, function (result, status, xhr) {
        if (status == "success") {
            var datos = new Array(0);
            try {
                datos = result;
            } catch (err) {
                datos.correctoV = false;
            }
            if (datos.correctoV) {
                vistaSiguiente = datos.vista;
                ocultarTodo();
            } else {
                MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
    });
}
function ocultarTodo() {
    $("#mostrarMensajeInformativo").show();
    $("#mostrarMensajeInformativo2").show();
    reproducirAudioCargado('idBuenTrabajo', "iconoRepetir", "fas fa-volume-off tamanoIcono", "fas fa-volume-up tamanoIcono")

    $('#btmComenzar').hide();
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#subPregunta').hide();
    $('#preguntaAdicional').hide();
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    $('#pregunta').hide();
    $('#idFotosGlobales').hide();
    $('#mocrofono').hide();
    $('#reconocimientoVoz').hide();
    $('#btn_next').hide();
}
function mostrarCampos(cantidad, tipoRespuesta) {
    let pantalla = vistaSiguiente;
    vistaSiguiente = '';
    $("#contenedor-Preguntas").html(pantalla);
}
function cambiarPreguntaEspecialOrden(controler, accion, tipoRespuesta, opcional = "") {
    var respuestas = new Array(0);
    let respuestasAux = new Array(0);
    let cont = document.getElementById('cantidadOpcionesRespuesta').value;
    let contador = 0;
    for (let i = 0; i < cont; i++) {
        if (document.getElementById('capRes' + i).checked) {
            let valor = document.getElementById('capRes' + i).value.split(' ');
            respuestasAux[valor[(valor.length - 1)]] = valor[0];
            contador++;
        }
    }
    contador = 0;
    respuestasAux.forEach(function (item) {
        respuestas[contador] = item;
        contador++;
    });
    if (contador == 0) {
        respuestas = [0];
    }
    let data = {
        respuestas: respuestas,
        codigoS: $('#codigoPregunta').val(),
    }
    $.post("index.php?r=" + controler + "/" + accion, data, function (result, status, xhr) {
        if (status == "success") {
            var datos = new Array(0);
            try {
                datos = result;
            } catch (err) {
                datos.correctoV = false;
            }
            if (datos.correctoV) {
                vistaSiguiente = datos.vista;
                ocultarTodo();
            } else {
                MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
    });
}
function cambiarPreguntaSinOrden(controler, accion, tipoRespuesta, opcional = "") {
    var respuestas = new Array(0);
    let respuestaTexto = '';
    let contador = 0;
    if ((tipoRespuesta == 'voz' || (tipoRespuesta == 'ambos' && document.getElementById("checkAvanzado").checked)) && opcional != "") {
        respuestaTexto = document.getElementById('texto').innerHTML.trim();
        respuestas = respuestaTexto.split(' ');
    } else {
        let respuestasAux = new Array(0);
        let cont = document.getElementById('cantidadOpcionesRespuesta').value;
        for (let i = 0; i < cont; i++) {
            if (document.getElementById('capRes' + i).checked) {
                let valor = document.getElementById('capRes' + i).value.split(' ');
                respuestasAux[valor[(valor.length - 1)]] = valor[0];
                contador++;
            }
        }
        contador = 0;
        respuestasAux.forEach(function (item) {
            respuestas[contador] = item;
            contador++;
        });
    }
    if (respuestaTexto == '' && contador == 0) {
        respuestas = [0];
    }
    let data = {
        respuestas: respuestas,
        codigoS: $('#codigoPregunta').val(),
        sinOrden: true,
    }
    $.post("index.php?r=" + controler + "/" + accion, data, function (result, status, xhr) {
        if (status == "success") {
            var datos = new Array(0);
            try {
                datos = result;
            } catch (err) {
                datos.correctoV = false;
            }
            if (datos.correctoV) {
                vistaSiguiente = datos.vista;
                ocultarTodo();
            } else {
                MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
    });
}
function cambiarPreguntaEspecialSinOrden(controler, accion, tipoRespuesta, opcional = "") {
    var respuestas = new Array(0);
    let respuestasAux = new Array(0);
    let cont = document.getElementById('cantidadOpcionesRespuesta').value;
    let contador = 0;
    for (let i = 0; i < cont; i++) {
        if (document.getElementById('capRes' + i).checked) {
            let valor = document.getElementById('capRes' + i).value.split(' ');
            respuestasAux[valor[(valor.length - 1)]] = valor[0];
            contador++;
        }
    }
    contador = 0;
    respuestasAux.forEach(function (item) {
        respuestas[contador] = item;
        contador++;
    });
    if (contador == 0) {
        respuestas = [0];
    }
    let data = {
        respuestas: respuestas,
        codigoS: $('#codigoPregunta').val(),
        sinOrden: true,
    }
    $.post("index.php?r=" + controler + "/" + accion, data, function (result, status, xhr) {
        if (status == "success") {
            var datos = new Array(0);
            try {
                datos = result;
            } catch (err) {
                datos.correctoV = false;
            }
            if (datos.correctoV) {
                vistaSiguiente = datos.vista;
                ocultarTodo();
            } else {
                MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta","MensajeRespuesta2");
    });
}
function MuestraMensajes(campo, campo2) {
    let cont = document.getElementById('cantidadOpcionesRespuesta').value;
    $('#' + campo).show();
    $('#' + campo2).show();
    document.querySelector("#checkAvanzado").checked = false;
    $('#reconocimientoVoz').hide();
    document.getElementById("btn_next").style.display = "none";
    $("#mocrofono").hide();
    for (var i = 0; i < cont; i++) {
        $("#labRes" + i).hide();
    }
    reproducirAudioCargado('idCambioAudioC', "iconoRepetir", 'fas fa-volume-off tamanoIcono', 'fas fa-volume-up tamanoIcono');
}
function MuestraMensajes2(campo, campo2) {
    let cont = document.getElementById('cantidadOpciones').value;
    $('#' + campo).show();
    $('#' + campo2).show();
    document.querySelector("#checkAvanzado").checked = false;
    $('#reconocimientoVoz').hide();
    document.getElementById("btn_next").style.display = "none";
    $("#mocrofono").hide();
    $("#btmContinuar").hide();
    $("#btmRepetir").hide();
    for (var i = 0; i < cont; i++) {
        $("#labRes" + i).hide();
        $("#lab" + i).hide();
    }
    reproducirAudioCargado('idCambioAudioC', "iconoRepetir", 'fas fa-volume-off tamanoIcono', 'fas fa-volume-up tamanoIcono');
}
function volverIntentar() {
    let cont = document.getElementById('cantidadOpciones').value;
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    document.getElementById("btn_next").style.display = "grid";
    $("#checkAvanzado").removeAttr('disabled');
    for (var i = 0; i < cont; i++) {
        $("#cap" + i).removeAttr('disabled');
        document.querySelector("#cap" + i).checked = false;
    }
}

/**
 * Si el botón de opción está marcado, agregue un espacio y el número de la respuesta al valor del
 * botón de opción.
 * @param rbutton - El botón de opción en el que se hizo clic.
 */
var era;
var previo = null;
var contadorRespuestas = 1;
function uncheckRadio(rbutton) {
    if (previo && previo != rbutton) {
        previo.era = false;
    }
    if (rbutton.checked == true && rbutton.era == true) {
        rbutton.checked = false;
    } else {
        rbutton.value = rbutton.value + " " + contadorRespuestas;
        contadorRespuestas++;
    }
    rbutton.era = rbutton.checked;
    previo = rbutton;
}

async function repetirImagenes(cantidad, tipoRespuesta) {
    $('#btmComenzar').hide();
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#subPregunta').hide();
    $('#preguntaAdicional').hide();
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    $('#pregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).hide();
    }
    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off tamanoIcono';
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).show();
        $('#idButton' + aux).show();
        $('#iconoButton' + aux).show();
        reproducir($("#cap" + aux).val(), "iconoButton" + aux, 'fas fa-volume-off tamanoIcono', 'fas fa-volume-up tamanoIcono');
        await sleep(2000);
    }
    $('#btmRepetir').show();
    $('#btmContinuar').show();
}
async function repetirImagenes2(cantidad, tipoRespuesta) {
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    if (tipoRespuesta == 'voz' || tipoRespuesta == 'ambos') {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).hide();
            let campoChecked = document.getElementById("capRes" + aux);
            if (campoChecked.checked) {
                campoChecked.checked = false;
            }
        }
        $('#mocrofono').show();
        document.getElementById("checkAvanzado").checked = true;
        $('#reconocimientoVoz').show();
    } else {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).show();
            let campoChecked = document.getElementById("capRes" + aux);
            if (campoChecked.checked) {
                campoChecked.checked = false;
            }
        }
    }
    $('#btn_next').show();
}
async function repetirImagenes3(cantidad, tipoRespuesta) {
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    if (tipoRespuesta == 'imagen') {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).show();
            let campoChecked = document.getElementById("capRes" + aux);
            if (campoChecked.checked) {
                campoChecked.checked = false;
            }
        }
    } else if (tipoRespuesta == 'ambos') {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).show();
            let campoChecked = document.getElementById("capRes" + aux);
            if (campoChecked.checked) {
                campoChecked.checked = false;
            }
        }
        $('#mocrofono').show();
    } else {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).hide();
            let campoChecked = document.getElementById("capRes" + aux);
            if (campoChecked.checked) {
                campoChecked.checked = false;
            }
        }
        $('#mocrofono').show();
        document.getElementById("checkAvanzado").checked = true;
        $('#reconocimientoVoz').show();
    }
    $('#btn_next').show();
}
async function repetirImagenes5(cantidad, tipoRespuesta) {
    $('#btmContinuar').hide();
    $('#subPregunta').hide();
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    $('#btmComenzar').hide();
    $('#pregunta').show();
    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off tamanoIcono';
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).show();
        $('#idButton' + aux).show();
        $('#iconoButton' + aux).show();
    }
    $('#btmRepetir').show();
    $('#btmContinuar').show();
}

async function repetirImagenes7(cantidad, tipoRespuesta) {
    $('#btmComenzar').hide();
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#preguntaAdicional').hide();
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    $('#pregunta').show();
    $('#subPregunta').show();
    $('#btmSubPregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#labRes' + aux).hide();
    }
    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioPegunta');
    let valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off tamanoIcono';

    let campoIcono2 = document.getElementById('iconoButtonSubPregunta');
    campoIcono2.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioSupPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono2.className = 'fas fa-volume-off tamanoIcono';

    $('#btmRepetir').show();
    $('#btmContinuar').show();
}

async function repetirImagenes8(cantidad, tipoRespuesta) {
    $('#btmComenzar').hide();
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    $('#pregunta').show();
    $('#subPregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#labRes' + aux).hide();
    }
    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioPegunta');
    let valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off tamanoIcono';

    let campoIcono2 = document.getElementById('iconoButtonSubPregunta');
    campoIcono2.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioSupPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono2.className = 'fas fa-volume-off tamanoIcono';

    $('#btmRepetir').show();
    $('#btmContinuar').show();
}
async function repetirImagenes9(cantidad, tipoRespuesta) {
    $('#btmComenzar').hide();
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#subPregunta').hide();
    $('#preguntaAdicional').hide();
    $('#MensajeRespuesta').hide();
    $('#MensajeRespuesta2').hide();
    $('#pregunta').show();

    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById('audioPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off tamanoIcono';
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).show();
        let campoChecked = document.getElementById("cap" + aux);
        if (campoChecked.checked) {
            campoChecked.checked = false;
        }

    }
    $('#btmContinuar').show();
}
async function siguientePregunta(cantidad, tipoRespuestas) {
    switch (tipoRespuestas) {
        case 'imagen':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#iconoButton' + aux).hide();
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                $('#idButton' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#preguntaAdicional').show();
            $('#subPregunta').hide();
            break;
        default:
            for (let aux = 0; aux < cantidad; aux++) {
                $('#iconoButton' + aux).hide();
                $('#lab' + aux).hide();
                $('#labRes' + aux).hide();
                $('#idButton' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
                //document.getElementById('cap' + aux).setAttribute('onclick', 'uncheckRadio(this)');
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            $('#subPregunta').show();
            break;
    }
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#btn_next').show();
    $('#pregunta').hide();

    reproducirAudioIcono('iconoButtonSubPregunta', 'audioSupPegunta');
}
function siguientePregunta3(cantidad, tipoRespuestas) {
    switch (tipoRespuestas) {
        case 'imagen':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#iconoButton' + aux).hide();
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                $('#idButton' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            break;
        case 'voz':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            break;
        default:
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            break;
    }

    $('#btmContinuar').hide();
    $('#btn_next').show();
    $('#pregunta').hide();
    $('#btmRepetir').hide();
    $('#subPregunta').show();

    reproducirAudioIcono('iconoButtonSubPregunta', 'audioSupPegunta');
}
async function siguientePregunta4(cantidad, tipoRespuestas) {
    switch (tipoRespuestas) {
        case 'imagen':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#iconoButton' + aux).hide();
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                $('#idButton' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            break;
        case 'voz':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            break;
        default:
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            break;
    }

    $('#btmContinuar').hide();
    $('#pregunta').hide();
    $('#subPregunta').hide();
    $('#btn_next').show();
    $('#preguntaAdicional').show();
    $('#btmRepetir').hide();

    reproducirAudioIcono('iconoButtonPreguntaAdicional', 'audioPreguntaAdicional');
}

async function reproducirAudioIcono(idIcono, idSonido) {
    let campoIcono2 = document.getElementById(idIcono);
    campoIcono2.className = 'fas fa-volume-up tamanoIcono';
    $reproducirAudioI = document.getElementById(idSonido);
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono2.className = 'fas fa-volume-off tamanoIcono';
}
function siguientePregunta2(cantidad, tipoRespuestas) {
    switch (tipoRespuestas) {
        case 'imagen':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            break;
        case 'voz':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            break;
        default:
            for (let aux = 0; aux < cantidad; aux++) {
                $('#lab' + aux).hide();
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            break;
    }
    $('#btmContinuar').hide();
    $('#btn_next').show();
    $('#pregunta').show();
    $('#subPregunta').show();
    $('#btmSubPregunta').hide();
    $('#subPregunta').hide();
    $('#btmRepetir').hide();

    reproducirAudioIcono('iconoButtonPregunta', 'audioPegunta');
}
function siguientePregunta5(cantidad, tipoRespuestas) {
    switch (tipoRespuestas) {
        case 'imagen':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').hide();
            $('#reconocimientoVoz').hide();
            break;
        case 'voz':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#labRes' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            break;
        default:
            for (let aux = 0; aux < cantidad; aux++) {
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
                //document.getElementById('cap' + aux).setAttribute('onclick', 'uncheckRadio(this)');
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').hide();
            break;
    }

    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#btn_next').show();
    $('#pregunta').show();
    $('#subPregunta').hide();

    reproducirAudioIcono('iconoButtonPregunta', 'audioPegunta');
}

function siguientePregunta6(cantidad, tipoRespuestas) {
    switch (tipoRespuestas) {
        case 'imagen':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#labRes' + aux).show();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').hide();
            $('#reconocimientoVoz').hide();
            break;
        case 'voz':
            for (let aux = 0; aux < cantidad; aux++) {
                $('#labRes' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            break;
        default:
            for (let aux = 0; aux < cantidad; aux++) {
                $('#labRes' + aux).hide();
                let campoChecked = document.getElementById("capRes" + aux);
                if (campoChecked.checked) {
                    campoChecked.checked = false;
                }
            }
            $('#mocrofono').show();
            $('#reconocimientoVoz').show();
            document.getElementById("checkAvanzado").checked = true;
            break;
    }

    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#btn_next').show();
    $('#pregunta').show();
    $('#subPregunta').hide();
    reproducirAudioIcono('iconoButtonPregunta', 'audioPegunta');
}
function siguientePregunta7(cantidad, tipoRespuestas) {
    let respuestasAux = new Array(0);
    var respuestas = new Array(0);
    let contador = 0;
    let cont = document.getElementById('cantidadOpciones').value;

    for (let i = 0; i < cont; i++) {
        if (document.getElementById('cap' + i).checked) {
            let valor = document.getElementById('cap' + i).value.split(' ');
            respuestasAux[valor[(valor.length - 1)]] = valor[0];
            contador++;
        }
    }
    contador = 0;
    respuestasAux.forEach(function (item) {
        respuestas[contador] = item;
        contador++;
    });

    if (contador == 0) {
        respuestas = [0];
    }
    let data = {
        respuestas: respuestas,
        codigoS: $('#codigoPregunta').val(),
    }
    $.post("index.php?r=sonidosiniciales/validar-imagenes", data, function (result, status, xhr) {
        if (status == "success") {
            var datos = new Array(0);
            try {
                datos = result;
            } catch (err) {
                datos.correctoV = false;
            }
            if (datos.correctoV) {
                for (let aux = 0; aux < cantidad; aux++) {
                    $('#lab' + aux).hide();
                    let campoChecked = document.getElementById("cap" + aux);
                    if (campoChecked.checked) {
                        campoChecked.checked = false;
                    }
                }

                switch (tipoRespuestas) {
                    case 'imagen':
                        for (let aux = 0; aux < datos.totalRespuestas; aux++) {
                            $('#labRes' + aux).show();
                            let campoChecked = document.getElementById("capRes" + aux);
                            if (campoChecked.checked) {
                                campoChecked.checked = false;
                            }
                        }
                        $('#mocrofono').hide();
                        break;
                    case 'voz':
                        for (let aux = 0; aux < datos.totalRespuestas; aux++) {
                            $('#labRes' + aux).hide();
                            let campoChecked = document.getElementById("capRes" + aux);
                            if (campoChecked.checked) {
                                campoChecked.checked = false;
                            }
                        }
                        $('#mocrofono').show();
                        $('#reconocimientoVoz').show();
                        document.getElementById("checkAvanzado").checked = true;
                        break;
                    case 'ambos':
                        for (let aux = 0; aux < datos.totalRespuestas; aux++) {
                            $('#labRes' + aux).show();
                            let campoChecked = document.getElementById("capRes" + aux);
                            if (campoChecked.checked) {
                                campoChecked.checked = false;
                            }
                        }
                        $('#mocrofono').show();
                        $('#reconocimientoVoz').hide();
                        break;
                }
                $('#btmRepetir').hide();
                $('#btmContinuar').hide();
                $('#btn_next').show();
                $('#pregunta').hide();
                $('#subPregunta').show();
                reproducirAudioIcono('iconoButtonSubPregunta', 'audioSupPegunta');
            } else {
                MuestraMensajes2("MensajeRespuesta","MensajeRespuesta2");
            }
        } else if (status == "error") {
            MuestraMensajes2("MensajeRespuesta","MensajeRespuesta2");
        }
    }).fail(function () {
        MuestraMensajes2("MensajeRespuesta","MensajeRespuesta2");
    });
}

async function reproducirAudioCargado(idAudio, idButonCambio, iconoAnterior, iconoNuevo) {
    let campoIcono = document.getElementById(idButonCambio);
    let antiguoIcono = campoIcono.className;
    campoIcono.className = iconoNuevo;
    $reproducirAudioI = document.getElementById(idAudio);
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = antiguoIcono;
}

function activarMicro(checkAvanzado, cantidad) {
    activar(checkAvanzado);
    if (checkAvanzado.checked) {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).hide();
        }
    } else {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).show();
        }
    }
}
function activarMicroCambioTexto(checkAvanzado, cantidad) {
    activar(checkAvanzado);
    if (checkAvanzado.checked) {
        $('#subPregunta').show();
        $('#preguntaAdicional').hide();

        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).hide();
        }
    } else {
        $('#subPregunta').hide();
        $('#preguntaAdicional').show();
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).show();
        }
    }
}
function activarMicroCambioTexto2(checkAvanzado, cantidad) {
    activar(checkAvanzado);
    if (checkAvanzado.checked) {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).hide();
        }
    } else {
        for (let aux = 0; aux < cantidad; aux++) {
            $('#labRes' + aux).show();
        }
    }
}

function activarMicroCambioTexto3(checkAvanzado, cantidad) {
    activar(checkAvanzado);
    if (checkAvanzado.checked) {
        document.getElementById('idtextoLabelVoz').style.display = "none";

    } else {
        document.getElementById('idtextoLabelVoz').style.display = "inline-table";

    }
}