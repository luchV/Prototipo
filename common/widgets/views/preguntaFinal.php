<div class="agileits-pricing-grid third">
    <div class="pricing_grid">
        <div class="wthree-pricing-info pricing-top green-top">
            <h3>
                <button id="idButtonFinal" style="background: transparent;" class="btnPersonalizado" onclick='reproducir("<?= $TextoTitulo ?>", "iconoButtonFinal","fas fa-volume-off tamanoIcono", "fas fa-volume-up tamanoIcono")'><em id="iconoButtonFinal" class="fas fa-volume-off tamanoIcono"></em></button>
                <?= $TextoTitulo ?>
                <em class="<?= $iconoTitulo ?>"></em>
            </h3>
        </div>
        <div class="pricing-bottom">
            <div class="pricing-bottom-bottom green-pricing-bottom-top" style="text-align: initial;">

                <p>
                    <span class="fas fa-check-double"></span>
                    <span>
                        <?php
                        for ($i = 0; $i < $textoSegundoCampo; $i++) {
                        ?>
                            <em class="fas fa-grin-alt tamanoIcono"></em>
                        <?php  } ?>
                    </span>
                </p>

                <p>
                    <span class="fas fa-times"></span>
                    <span>
                        <?php
                        for ($i = 0; $i < $textoTercerCampo; $i++) {
                        ?>
                            <em class="fas fa-grin-beam-sweat tamanoIcono"></em>
                        <?php  } ?>
                    </span>
                </p>
            </div>
            <div class="buy-button">
                <a href="<?= $redireccion ?>" class="link-button"><?= $textoBoton ?></a>
            </div>
        </div>
    </div>
</div>