<div class="row" id='<?= $idDivGeneral ?>' <?= $ocultarCampo ?>>
    <?php if (isset($audioCargado) && $audioCargado != '') { ?>
        <audio id='<?= $idAudio ?>' preload="metadata">
            <source src="https://docs.google.com/uc?export=open&id=<?= $audioCargado  ?>" type="audio/mp3">
        </audio>
    <?php } ?>
    <div class="col-md-12">
        <?php if (isset($audioCargado) && $audioCargado != '') { ?>
            <button class="btn btn-primary text-center btnPersonalizado" onclick="reproducirAudioCargado('<?= $idAudio ?>','<?= $idIconoButton ?>','fas fa-volume-off tamanoIcono','fas fa-volume-up tamanoIcono')"><em id='<?= $idIconoButton ?>' class="fas fa-volume-off tamanoIcono"></em></button>
            &nbsp;&nbsp;
        <?php } ?>
        <label id="<?= $idLabel ?>" name="<?= $idLabel ?>" class="textoPreguntas">
            <?= $textoCampo ?>
        </label>
    </div>
</div>