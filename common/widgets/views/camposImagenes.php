<div class="row" id="idFotosGlobales">
    <div class="col-md-12 text-center">
        <?php
        $arrayDesorden = [];
        //Desordenar
        foreach ($modelRespuestas as $imagenes) {
            array_push($arrayDesorden, ['respuestaTexto' => $imagenes["respuestaTexto"], 'imagen' => $imagenes["imagen"]]);
        }
        shuffle($arrayDesorden);
        $contRes = 0;
        $countAux = 0;
        foreach ($arrayDesorden as $imagenes) {
            if ($countAux > 6) {
                $countAux = 0;
        ?>
                <br />
            <?php
            }
            ?>
            <label id="labRes<?= $contRes ?>" style="display:none;">
                <label class="checkeable" style="margin: 2%;" id="labelRes<?= $contRes ?>">
                    <input type="radio" style="display:none;" id="capRes<?= $contRes ?>" onclick="uncheckRadio(this)" name="seleccionImagenRes<?= $contRes ?>" value='<?= $imagenes["respuestaTexto"] ?>' />
                    <img src='https://drive.google.com/uc?export=view&id=<?= $imagenes["imagen"] ?>' height="151px" width="151px" hspace="25">
                </label>
            </label>
        <?php
            $countAux++;
            $contRes++;
        }
        ?>
        <input id="cantidadOpcionesRespuesta" style="display:none;" value="<?= $totalRespuestas ?>">
    </div>
</div>