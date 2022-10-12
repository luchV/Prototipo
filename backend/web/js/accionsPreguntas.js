var textErrorMensaje = document.querySelector('.mensajeMuestra');

function cambiarPregunta(controler, accion) {
    let cont = document.getElementById('cantidadOpciones').value;
    var respuestas = new Array(0);
    var contador = 0;
    for (var i = 0; i < cont; i++) {
        if (document.getElementById('cap' + i).checked) {
            respuestas[contador] = document.getElementById('cap' + i).value;
            contador++;
        }
    }
    $.get("index.php?r=" + controler + "/" + accion + "&respuestas=" + respuestas, function (result, status, xhr) {
        if (status == "success") {
            var datos = new Array(0);
            try {
                datos = result;
            } catch (err) {
                datos.transaccion = false;
            }
            if (datos.transaccion) {
                $("#contenedor-Preguntas").html(datos.vista);
                //MuestraMensajes(datos.errorDescripcion, "MensajeRespuesta", "green", "fas fa-check-circle");
            } else {
                MuestraMensajes(datos.errorDescripcion, "MensajeRespuesta", "red", "fas fa-times-circle");
            }
        } else if (status == "error") {
            MuestraMensajes("No existe respuesta", "MensajeRespuesta", "red", "fas fa-times-circle");
        }
    }).fail(function () {
        MuestraMensajes("Ha ocurrido un error, por favor volver a intentar.", "MensajeRespuesta", "red", "fas fa-times-circle");
    });
}
function MuestraMensajes(mensaje, campo, colorMuestra, icono) {
    let cont = document.getElementById('cantidadOpciones').value;
    document.getElementById(campo).style.display = "grid";
    textErrorMensaje.textContent = mensaje;
    document.getElementById('iconoRespuesta').style.color = colorMuestra;
    document.getElementById('iconoRespuesta').className = icono;
    document.querySelector("#checkAvanzado").checked = false;
    document.getElementById("reconocimientoVoz").style.display = "none";
    document.getElementById("btn_next").style.display = "none";
    $("#checkAvanzado").attr('disabled', 'disabled');
    for (var i = 0; i < cont; i++) {
        $("#cap" + i).attr('disabled', 'disabled');
    }
}
function volverIntentar() {
    let cont = document.getElementById('cantidadOpciones').value;
    document.getElementById("MensajeRespuesta").style.display = "none";
    textErrorMensaje.textContent = "";
    document.getElementById("btn_next").style.display = "grid";
    $("#checkAvanzado").removeAttr('disabled');
    for (var i = 0; i < cont; i++) {
        $("#cap" + i).removeAttr('disabled');
        document.querySelector("#cap" + i).checked = false;
    }
}
var era;
var previo = null;
function uncheckRadio(rbutton) {
    if (previo && previo != rbutton) { previo.era = false; }
    if (rbutton.checked == true && rbutton.era == true) { rbutton.checked = false; }
    rbutton.era = rbutton.checked;
    previo = rbutton;
}