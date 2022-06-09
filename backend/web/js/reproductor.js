function reproducirTitulo(campo) {
    var texto = (document.getElementById(campo).innerHTML).trim();
    reproducir(texto);
}
function reproducir(texto) {
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
    }, 1000);
}
