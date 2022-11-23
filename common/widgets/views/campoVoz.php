<div id="mocrofono" <?= $ocultarCampoGeneral ?> <?= $funcionActiva != 'realizarReconocimientSoloVoz' ? $difetenteEstilo : '' ?>>
    <br />
    <Label id="idtextoLabel" class="fotosMicrofono" title="Activar Fotos">
        <em class='fa fa-picture-o tamanoIcono' style="color: var(--color-foto-icono);"></em>
    </Label>
    <div <?= $claseCheck ?>>
        <input type="checkbox" id="checkAvanzado" value="Valor" onclick="<?= $funcionVoz ?>(this,<?= $totalRespuestas ?>)" <?= $soloVoz ?> <?= $vozActiva ?> />
        <label for="checkAvanzado"></label>
    </div>
    <Label id="idtextoLabelVoz" class="fotosMicrofono" title="Activar micrófono">
        <em class='fas fa-microphone tamanoIcono' style="color: var(--color-microfono-icono);"></em>
    </Label>

    <div id="reconocimientoVoz" <?= $oculptarCampoMicro ?> style="cursor: pointer;">
        <button class="btn btn-primary text-center btnPersonalizado2" onclick="<?= $funcionActiva ?>()"><em id="start_img" style="cursor: pointer;" class="fas fa-microphone-alt tamanoIcono2"></em></button>
        <label id="texto" style="display:none;" name="texto"></label>
        <div id="errorMensaje" style="display:none;">
            <p class="error"></p>
        </div>
    </div>
</div>