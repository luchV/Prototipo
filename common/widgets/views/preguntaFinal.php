<div class="agileits-pricing-grid third">
    <div class="pricing_grid">
        <div class="wthree-pricing-info pricing-top green-top">
            <h3>
                <button id="idButtonFinal" style="background: transparent;" class="btnPersonalizado" onclick='reproducir("<?= $TextoTitulo ?>", "iconoButtonFinal","fas fa-volume-off", "fas fa-volume-up")'><em id="iconoButtonFinal" class="fas fa-volume-off tamanoIcono"></em></button>
                <?= $TextoTitulo ?>
                <em class="<?= $iconoTitulo ?>"></em>
            </h3>
        </div>
        <div class="pricing-bottom">
            <div class="pricing-bottom-bottom green-pricing-bottom-top" style="text-align: initial;">
                <p><span class="fas fa-check-double"></span><span><?= $primerCampo ?></span> <?= $textoPrimerCampo ?></p>
                <p><span class="fas fa-check-double"></span><span><?= $segundoCampo ?></span> <?= $textoSegundoCampo ?></p>
                <p><span class="fas fa-times"></span><span><?= $tercerCampo ?></span> <?= $textoTercerCampo ?></p>
            </div>
            <div class="buy-button">
                <a href="<?= $redireccion ?>" class="link-button"><?= $textoBoton ?></a>
            </div>
        </div>
    </div>
</div>