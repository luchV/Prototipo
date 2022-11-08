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
        MuestraMensajes("MensajeRespuesta");
        return false;
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
                datos.transaccion = false;
            }
            if (datos.transaccion) {
                $("#contenedor-Preguntas").html(datos.vista);
            } else {
                MuestraMensajes("MensajeRespuesta");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta");
    });
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
        MuestraMensajes("MensajeRespuesta");
        return false;
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
                datos.transaccion = false;
            }
            if (datos.transaccion) {
                $("#contenedor-Preguntas").html(datos.vista);
            } else {
                MuestraMensajes("MensajeRespuesta");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta");
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
        MuestraMensajes("MensajeRespuesta");
        return false;
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
                datos.transaccion = false;
            }
            if (datos.transaccion) {
                $("#contenedor-Preguntas").html(datos.vista);
            } else {
                MuestraMensajes("MensajeRespuesta");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta");
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
        MuestraMensajes("MensajeRespuesta");
        return false;
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
                datos.transaccion = false;
            }
            if (datos.transaccion) {
                $("#contenedor-Preguntas").html(datos.vista);
            } else {
                MuestraMensajes("MensajeRespuesta");
            }
        } else if (status == "error") {
            MuestraMensajes("MensajeRespuesta");
        }
    }).fail(function () {
        MuestraMensajes("MensajeRespuesta");
    });
}
function MuestraMensajes(campo) {
    let cont = document.getElementById('cantidadOpcionesRespuesta').value;
    document.getElementById(campo).style.display = "grid";
    document.querySelector("#checkAvanzado").checked = false;
    document.getElementById("reconocimientoVoz").style.display = "none";
    document.getElementById("btn_next").style.display = "none";
    $("#mocrofono").hide();
    for (var i = 0; i < cont; i++) {
        $("#labRes" + i).hide();
    }
    reproducir('Intentalo de nuevo', "iconoRepetir", 'fas fa-volume-off', 'fas fa-volume-up');
}
function volverIntentar() {
    let cont = document.getElementById('cantidadOpciones').value;
    document.getElementById("MensajeRespuesta").style.display = "none";
    document.getElementById("btn_next").style.display = "grid";
    $("#checkAvanzado").removeAttr('disabled');
    for (var i = 0; i < cont; i++) {
        $("#cap" + i).removeAttr('disabled');
        document.querySelector("#cap" + i).checked = false;
    }
}
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
    $('#MensajeRespuesta').hide();
    $('#pregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).hide();
    }
    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up';
    $reproducirAudioI = document.getElementById('audioPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off';
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).show();
        $('#idButton' + aux).show();
        $('#iconoButton' + aux).show();
        reproducir($("#cap" + aux).val(), "iconoButton" + aux, 'fas fa-volume-off', 'fas fa-volume-up');
        await sleep(2000);
    }
    $('#btmRepetir').show();
    $('#btmContinuar').show();
}
async function repetirImagenes2(cantidad, tipoRespuesta) {
    $('#MensajeRespuesta').hide();
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
async function repetirImagenes4(cantidad, tipoRespuesta) {
    $('#MensajeRespuesta').hide();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#labRes' + aux).hide();
        let campoChecked = document.getElementById("capRes" + aux);
        if (campoChecked.checked) {
            campoChecked.checked = false;
        }
    }
    $('#mocrofono').hide();
    $('#subPregunta').show();
    $('#btmSubPregunta').show();
    $('#btmContinuar').show();
}
async function repetirImagenes5(cantidad, tipoRespuesta) {
    $('#btmContinuar').hide();
    $('#subPregunta').hide();
    $('#MensajeRespuesta').hide();
    $('#pregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).show();
        $('#idButton' + aux).show();
        $('#iconoButton' + aux).show();
    }
    $('#btmRepetir').show();
    $('#btmContinuar').show();
}
async function repetirImagenes6(cantidad, tipoRespuesta) {
    $('#btmContinuar').hide();
    $('#subPregunta').show();
    $('#MensajeRespuesta').hide();
    $('#pregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#lab' + aux).show();
        $('#idButton' + aux).show();
        $('#iconoButton' + aux).show();
    }
    $('#btmRepetir').show();
    $('#btmContinuar').show();
    $('#preguntaAdicional').hide();
}
async function repetirImagenes7(cantidad, tipoRespuesta) {
    $('#btmComenzar').hide();
    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#MensajeRespuesta').hide();
    $('#pregunta').show();
    $('#subPregunta').show();
    for (let aux = 0; aux < cantidad; aux++) {
        $('#labRes' + aux).hide();
    }
    let campoIcono = document.getElementById('iconoButtonPregunta');
    campoIcono.className = 'fas fa-volume-up';
    $reproducirAudioI = document.getElementById('audioPegunta');
    let valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono.className = 'fas fa-volume-off';

    let campoIcono2 = document.getElementById('iconoButtonSubPregunta');
    campoIcono2.className = 'fas fa-volume-up';
    $reproducirAudioI = document.getElementById('audioSupPegunta');
    valor = $reproducirAudioI.duration;
    $reproducirAudioI.play();
    await sleep((valor + 1) * 1000);
    campoIcono2.className = 'fas fa-volume-off';

    $('#btmRepetir').show();
    $('#btmContinuar').show();
}

function siguientePregunta(cantidad, tipoRespuestas) {
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
            break;
    }

    $('#btmRepetir').hide();
    $('#btmContinuar').hide();
    $('#btn_next').show();
    $('#pregunta').hide();
    $('#subPregunta').show();
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
    $('#subPregunta').show();
}
function siguientePregunta4(cantidad, tipoRespuestas) {
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
    $('#subPregunta').show();
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