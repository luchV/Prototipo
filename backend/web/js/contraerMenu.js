$(document).ready(function () {
  let estado = leerVariableMenu("menu");
  let elementosTitulo = document.getElementsByClassName("tituloSecciones");
  let elementosNombres = document.getElementsByClassName("tituloNombres");

  if (document.getElementById("body")) {
    if (estado == "activo") {
      $("#menu_side").toggleClass("");
      quitarCampo(elementosNombres);
      quitarCampo(elementosTitulo);
    } else {
      body.classList.add("body_move");
      side_menu.classList.add("menu__side_move");
      ponerCampo(elementosNombres);
      ponerCampo(elementosTitulo);
    }
  }
  $("#btn_open").on("click", function () {
    estado = leerVariableMenu("menu");
    if (estado == "activo") {
      ingresarVariableMenu("menu", "inactivo");
      ponerCampo(elementosNombres);
      ponerCampo(elementosTitulo);
    } else {
      ingresarVariableMenu("menu", "activo");
      quitarCampo(elementosNombres);
      quitarCampo(elementosTitulo);
    }
    $("#menu_side").toggleClass("")
  });
});
function ingresarVariableMenu(nombre, valor) {
  let testvalue = valor;
  document.cookie = nombre + "=" + encodeURIComponent(testvalue) + "; path=/";
}
function leerVariableMenu(name) {
  let nameEQ = name + "=";
  let ca = document.cookie.split(';');
  for (let valor of ca) {
    let c = valor;
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) {
      return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
  }
}

function quitarCampo(campoquitar) {
  [...campoquitar].forEach(child => {
    child.setAttribute('style', 'display: none !important');
  });
}

function ponerCampo(campoquitar) {
  [...campoquitar].forEach(child => {
    child.removeAttribute('style');
  });
}
