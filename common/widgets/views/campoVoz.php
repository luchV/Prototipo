<div id="mocrofono" <?= $ocultarCampoGeneral ?>>
    <br>
    <Label id="idtextoLabel" class="fotosMicrofono" title="Activar Fotos">
        <em class='fa fa-picture-o tamanoIcono' style="color: #0855a7;"></em>
    </Label>
    <div <?= $claseCheck ?>>
        <input type="checkbox" id="checkAvanzado" value="Valor" onclick="<?= $funcionVoz ?>(this,<?= $totalRespuestas ?>)" <?= $soloVoz ?> <?= $vozActiva ?> />
        <label for="checkAvanzado"></label>
    </div>
    <Label id="idtextoLabel" class="fotosMicrofono" title="Activar micrófono">
        <em class='fas fa-microphone tamanoIcono' style="color: #ab434d;"></em>
    </Label>

    <div id="reconocimientoVoz" <?= $oculptarCampoMicro ?> style="cursor: pointer;">
        <br>
        <button class="btn btn-primary text-center btnPersonalizado2" onclick="<?= $funcionActiva ?>()"><em id="start_img" style="cursor: pointer;" class="fas fa-microphone-alt tamanoIcono2"></em></button>
        <label id="texto" style="display:none;" name="texto"></label>
        <div id="errorMensaje" style="display:none;">
            <p class="error"></p>
        </div>
    </div>
</div>
<br>