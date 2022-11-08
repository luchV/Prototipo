<?php

use yii\helpers\Html;
?>

<div class="d-flex">
    <?php if ($editarBoton) { ?>
        <?= Html::a(Yii::t('app', 'Actualizar'), [$accionActualizar, 'id' => $idBoton], ['class' => 'btn btn-primary']) ?>
    <?php } ?>

    <?php if ($desactivarBoton) { ?>
        <a class="btn btn-secondary" onClick='accionBoton("desactivar","<?= $accionDesactivar ?>","<?= $mensajeMuestraDesactivar ?>", "info")'>Desactivar</a>
    <?php } ?>

    <?php if ($eliminarBoton) { ?>
        <a class="btn btn-danger" onClick='accionBoton("eliminar permanentemente","<?= $accionEliminar ?>","<?= $mensajeMuestraEliminar ?>", "error")'>Eliminar</a>
    <?php } ?>
</div>
<script type="text/javascript">
    //Poner la primera letra en mayuscula
    function capitalizarPrimeraLetra(str) {
        const palabras = str.split(" ");

        for (let i = 0; i < palabras.length; i++) {
            palabras[i] = palabras[i][0].toUpperCase() + palabras[i].substr(1);
        }
        return palabras.join(" ");;
    }

    function accionBoton(titulo, accion, mensajeMuestra, icono) {
        swal({
                title: capitalizarPrimeraLetra(titulo),
                text: mensajeMuestra + ": <?= $mensajeNombre ?>",
                icon: icono,
                buttons: ["Cancelar", "Aceptar"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $("#user-usuencargado").empty().append('');
                    $.get('index.php?r=<?= $controller ?>/' + accion + '&id=<?= $idBoton ?>', function(result, status, xhr) {
                        if (status == "success") {
                            let resultado = new Array(0);
                            try {
                                resultado = jQuery.parseJSON(result);
                                if (resultado.correcto) {
                                    swal(resultado.mensajeCorrecto, {
                                        icon: "success",
                                    });
                                    $("#error").hide();
                                    $("#error").text("");
                                    setTimeout(function() {
                                        window.location.href = resultado.url;
                                    }, resultado.tiempoActualizar);
                                } else {
                                    $("#error").show();
                                    $("#error").text(resultado.error);
                                }
                            } catch (err) {
                                $("#error").show();
                                $("#error").text("Error al momento de intentar realizar la acción.");
                            }
                        }
                    }).fail(function() {
                        $("#error").show();
                        $("#error").text("Error al momento de intentar realizar la acción.");
                    });
                }
            });
    }
</script>