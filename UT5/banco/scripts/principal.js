window.addEventListener('load', init);
function init() {
    var parrafo = document.createElement('p');
    var texto = document.createTextNode('Buenos dias');
    var parrafo2 = document.createElement('p');
    var texto2 = document.createTextNode('Esto es otro texto de prueba');
    parrafo2.appendChild(texto2);
    parrafo.appendChild(texto);
    // document.querySelector('body')?.appendChild(parrafo);
    // document.querySelector('body')?.appendChild(parrafo2);
}
