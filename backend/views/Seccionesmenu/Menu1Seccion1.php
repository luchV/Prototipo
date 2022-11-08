<?php

use yii\helpers\Html;
use common\models\Menus;
use common\models\Params;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$menus = Menus::findByIdPadre(
    $modelo['id_Padre'],
    Params::ins_codigo
);

$this->title = $menus["men_nombre"];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="contenedor-Preguntas">
    <div class="Menus-create">
        <div class="col-md-12" id="btn_next">
            <br>
            <div class="form-group" style="text-align: end !important;">
                <?= Html::submitButton(Yii::t('app', 'Siguiente <em class="fas fa-arrow-right"></em>'), ['class' => 'btn btn-primary text-center', 'onclick' => 'cambiarPregunta("' . $controller . '","' . $accion . '")']) ?>
            </div>
        </div>
        <div class="name-tag">
            <h1><?= Html::encode($menus["men_nombre"]) ?></h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label id="preguntaID" name="preguntaID">
                    <?= $modelo["secc_pregunta"] ?>
                </label>
                <button class="btnPersonalizado" onclick="reproducirTitulo('preguntaID')"><em class="fas fa-volume-up"></em></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label id="subpreguntaID" name="subpreguntaID">
                    <?= $modelo["secc_subpregunta"] ?>
                </label>
                <button class="btnPersonalizado" onclick="reproducirTitulo('subpreguntaID')"><em class="fas fa-volume-up"></em></button>
            </div>
        </div>
        <Label>
            Activar micrófono
        </Label>
        <div class="checkbox-JASoft">
            <input type="checkbox" id="checkAvanzado" value="Valor" onclick="activar(this)" />
            <label for="checkAvanzado"></label>
        </div>

        <div id="reconocimientoVoz" style="display:none;">
            <button class="btnPersonalizado2"><em id="start_img" onclick="realizarReconocimiento()" style="cursor: pointer;" class="fas fa-microphone-alt"></em></button>
            <label id="texto" style="display:none;" name="texto"></label>
            <div id="errorMensaje" style="display:none;">
                <p class="error"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <input id="cantidadOpciones" style="display:none;" value="<?= count($modelo['secc_respuestas']) ?>">

                <?php
                $cont = 0;
                foreach ($modelo['secc_respuestas'] as $imagenes) {
                ?>
                    <label class="checkeable">
                        <input type="radio" onclick="uncheckRadio(this)" id="cap<?= $cont ?>" name="seleccionImagen" value='<?= $imagenes["text"] ?>' />
                        <img src=<?= $imagenes["img"] ?> height="151px" width="151px" hspace="25">
                    </label>
                <?php
                    $cont++;
                }
                ?>
            </div>
        </div>
        <div id="MensajeRespuesta" style="display:none;">
            <em id="iconoRespuesta" style="font-size: 400%;"></em>
            <p class="errorMensaje"></p>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Volver a intentar <em class="fas fa-undo-alt"></em>'), ['class' => 'btn btn-primary text-center', 'onclick' => 'volverIntentar()']) ?>
            </div>
        </div>
    </div>
</div>
<script src="js/reconocimiento.js">
</script>
<script src="js/accionsPreguntas.js">
</script>