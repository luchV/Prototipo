const texto = document.getElementById('texto');
var activo = false;

if (!("webkitSpeechRecognition" in window)) {
	let textError = document.querySelector('.error');
	textError.textContent = 'Disculpas, no puedes usar el reconocimiento de voz en tu navegador.';
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
		escucha.className = 'fas fa-microphone-alt tamanoIcono2';
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
			textError.textContent = 'No se seleccionó ninguna opción, vuelva a intentarlo.';
		} else {
			textError.textContent = '';
			document.getElementById("errorMensaje").style.display = "none";
		}
	} else {
		escucha.className = 'fas fa-microphone-alt-slash tamanoIcono2';
		activo = true;
		recognition.start();
	}
}
function realizarReconocimientoMultipleOrdenado() {
	let textError = document.querySelector('.error');
	let escucha = document.querySelector('#start_img');
	let cont = document.getElementById('cantidadOpcionesRespuesta').value;
	if (activo) {
		recognition.abort();
		escucha.className = 'fas fa-microphone-alt tamanoIcono2';
		activo = false;
		let seleccionCorrecta = false;
		for (var i = 0; i < cont; i++) {
			let valorBusqueda = (document.getElementById('capRes' + i).value).split(' ');
			if ((texto.innerHTML).localeCompare(valorBusqueda[0], undefined, { sensitivity: 'base' }) == 0) {
				if (document.querySelector('#capRes' + i).checked) {
					document.querySelector('#capRes' + i).checked = false;
				} else {
					document.querySelector('#capRes' + i).checked = true;
					uncheckRadio(document.querySelector('#capRes' + i)); 
				}
				seleccionCorrecta = true;
			}
		}
		if (!seleccionCorrecta) {
			document.getElementById("errorMensaje").style.display = "grid";
			textError.textContent = 'No se seleccionó ninguna opción, vuelva a intentarlo.';
		} else {
			textError.textContent = '';
			document.getElementById("errorMensaje").style.display = "none";
		}
	} else {
		escucha.className = 'fas fa-microphone-alt-slash tamanoIcono2';
		activo = true;
		recognition.start();
	}
}
function realizarReconocimientSoloVoz() {
	let escucha = document.querySelector('#start_img');
	if (activo) {
		recognition.abort();
		escucha.className = 'fas fa-microphone-alt tamanoIcono2';
		activo = false;
	} else {
		escucha.className = 'fas fa-microphone-alt-slash tamanoIcono2';
		activo = true;
		recognition.start();
	}
}

function activar(checkAvanzado) {
	let textError = document.getElementById('error');
	if (checkAvanzado.checked) {
		$('#reconocimientoVoz').show();
	} else {
		$('#reconocimientoVoz').hide();
		textError.textContent = '';
		texto.innerHTML = '';
	}
}