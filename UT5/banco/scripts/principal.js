<<<<<<< HEAD
"use strict";
window.addEventListener('load', init);
function init() {
    var parrafo = document.createElement('p');
    var texto = document.createTextNode('Buenos dias');
    var parrafo2 = document.createElement('p');
    var texto2 = document.createTextNode('Esto es otro texto de prueba');
    parrafo2.appendChild(texto2);
    parrafo.appendChild(texto);
=======
import { manejarVisor } from "./utils/visorConexion.js";
window.addEventListener('load', init);
function init() {
    manejarVisor();
>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
}
