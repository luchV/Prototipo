function reproducirTitulo(campo) {
    var texto = (document.getElementById(campo).innerHTML).trim();
    reproducir(texto);
}
async function reproducir(texto, idButonCambio, iconoAnterior, iconoNuevo) {
    let campoIcono = document.getElementById(idButonCambio);
    campoIcono.className = iconoNuevo;
    // Tell Chrome to wake up and get the voices.
    var utterance = new SpeechSynthesisUtterance();
    speechSynthesis.getVoices();
    utterance.voice = speechSynthesis.getVoices()[11];
    setTimeout(function () {
        var agnesIndex = speechSynthesis.getVoices().findIndex(function (voice) {
            return voice.name === 'Microsoft Pablo - Spanish (Spain)';
        });
        utterance.voice = speechSynthesis.getVoices()[agnesIndex];
        utterance.text = texto;
        utterance.volume = 0.9;
        utterance.rate = 0.6;
        utterance.pitch = 0.3;
        speechSynthesis.speak(utterance);
    }, 40);
    await sleep(2000);
    campoIcono.className = iconoAnterior;
}
const sleep = (milliseconds) => {
    return new Promise(resolve => setTimeout(resolve, milliseconds))
}
