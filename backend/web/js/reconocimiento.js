var textError = document.querySelector('.error');
var escucha = document.querySelector('#start_img');
var activo = false;
const btnStartRecord = document.getElementById('btncomienzo');
const checkAvanzado = document.getElementById('checkAvanzado');
const texto = document.getElementById('texto');
if (!("webkitSpeechRecognition" in window)) {
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
btnStartRecord.addEventListener('click', () => {
	var cont = 4;
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
});

checkAvanzado.addEventListener('click', () => {
	if (checkAvanzado.checked) {
		document.getElementById("reconocimientoVoz").style.display = "grid";
	} else {
		document.getElementById("reconocimientoVoz").style.display = "none";
		textError.textContent = '';
		texto.innerHTML = '';
	}
});