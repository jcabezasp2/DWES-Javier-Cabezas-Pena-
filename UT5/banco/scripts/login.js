import Usuario from "./usuario.js";
import { iniciar } from "./utils/iniciador.js";
import { comprobarFormulario } from "./utils/form.js";
import { setCookie } from "./utils/coockies.js";
window.addEventListener('load', initLogin);
function initLogin() {
    document.querySelector('#login').addEventListener('click', enviar);
    iniciar();
}
let ajax;
function enviar() {
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    if (comprobarFormulario([email, password])) {
        let emailValue = email.value;
        let passwordValue = password.value;
        // Comprobamos que está disponible AJAX
        if (window.XMLHttpRequest) {
            ajax = new XMLHttpRequest();
        }
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    //alert(ajax.responseText)
                    login(ajax.response);
                }
            }
        };
        ajax.open("POST", "./php/log.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&email=" + emailValue + "&password=" + passwordValue);
    }
}
function login(respuesta) {
    if (respuesta == 2) {
        //Contraseña incorrecta
        let input = document.querySelector('#password');
        input.focus();
        input.parentElement.style.backgroundColor = 'red';
    }
    else if (respuesta == 3) {
        //El usuario no existe
        let input = document.querySelector('#email');
        input.focus();
        input.parentElement.style.backgroundColor = 'red';
    }
    else {
        let id = respuesta.split(':')[0];
        let nombre = respuesta.split(':')[1];
        let usuario = new Usuario(id, nombre);
        setCookie('id', usuario.idCliente, 1);
        localStorage.setItem('usuario', JSON.stringify(usuario));
        window.location.href = 'index.html';
    }
}
