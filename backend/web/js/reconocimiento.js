const texto = document.getElementById('texto');
var activo = false;

if (!("webkitSpeechRecognition" in window)) {
	let textError = document.querySelector('.error');
	textError.textContent = 'Disculpas, no puedes usar el reconocimiento de voz en tu navegador';
}
let recognition = new webkitSpeechRecognition();
recognition.lang = 'es-VE';
recognition.continuous = true;
recognition.interimResults = true;
recognition.onresult = (event) => {
	const results = event.results;
	const frase = results[results.length - 1][0].transcript;
	texto.innerHTML = frase;
}
function realizarReconocimiento() {
	let textError = document.querySelector('.error');
	let escucha = document.querySelector('#start_img');
	let cont = document.getElementById('cantidadOpciones').value;
	if (activo) {
		recognition.abort();
		escucha.className = 'fas fa-microphone-alt';
		activo = false;
		let seleccionCorrecta = false;
		for (var i = 0; i < cont; i++) {
			if ((texto.innerHTML).localeCompare(document.getElementById('cap' + i).value, undefined, { sensitivity: 'base' }) == 0) {
				document.querySelector('#cap' + i).checked = true;
				seleccionCorrecta = true;
			} else {
				document.querySelector('#cap' + i).checked = false;
			}
		}
		if (!seleccionCorrecta) {
			document.getElementById("errorMensaje").style.display = "grid";
			textError.textContent = 'No se seleccionó ninguna opción, vuelva a intentarlo';
		} else {
			textError.textContent = '';
			document.getElementById("errorMensaje").style.display = "none";
		}
	} else {
		escucha.className = 'fas fa-microphone-alt-slash';
		activo = true;
		recognition.start();
	}
}
function activar(checkAvanzado) {
	let textError = document.querySelector('.error');
	if (checkAvanzado.checked) {
		document.getElementById("reconocimientoVoz").style.display = "grid";
	} else {
		document.getElementById("reconocimientoVoz").style.display = "none";
		textError.textContent = '';
		texto.innerHTML = '';
	}
}