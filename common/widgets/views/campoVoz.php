<div id="mocrofono" <?= $ocultarCampoGeneral ?>>
    <br>
    <Label id="idtextoLabel">
        <?= $textoCampo1 ?> &nbsp;&nbsp;
    </Label>
    <div <?= $claseCheck ?>>
        <input type="checkbox" id="checkAvanzado" value="Valor" onclick="<?= $funcionVoz ?>(this,<?= $totalRespuestas ?>)" <?= $soloVoz ?> <?= $vozActiva ?> />
        <label for="checkAvanzado"></label>
    </div>
    <?php if (isset($textoCampo2)) { ?>
        <Label id="idtextoLabelSegundo">
            &nbsp;&nbsp; <?= $textoCampo2 ?>
        </Label>
    <?php }  ?>
    <div id="reconocimientoVoz" <?= $oculptarCampoMicro ?>>
        <button class="btnPersonalizado2"><em id="start_img" onclick="<?= $funcionActiva ?>()" style="cursor: pointer;" class="fas fa-microphone-alt"></em></button>
        <label id="texto" style="display:none;" name="texto"></label>
        <div id="errorMensaje" style="display:none;">
            <p class="error"></p>
        </div>
    </div>
</div>
<br>