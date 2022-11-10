<button class="btn btn-primary text-center" id="btmComenzar" onclick="<?= $funcionRepetir ?>(<?= $totalFotos ?>)"><em class="fab fa-google-play"></em> Comenzar <em class="fab fa-google-play" style="transform: rotate(180deg);"></em></button>
<button class="btn btn-primary text-center" style="display:none;" id="btmRepetir" onclick="<?= $funcionRepetir ?>(<?= $totalFotos ?>)"> Repetir <em class="fa fa-repeat" style="transform: rotate(180deg);"></em></button>
</br>
</br>
<button class="btn btn-primary text-center" style="" id="btmContinuar" onclick="<?= $funcionContinuar ?>(<?= $totalFotosSegundo  ?>,'<?= $secTipoRespuesta ?>')"> Continuar <em class="fas fa-arrow-right"></em></button>