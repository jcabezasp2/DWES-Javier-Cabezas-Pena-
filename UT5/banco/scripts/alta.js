import { comprobarFormulario } from "./utils/form.js";
import { iniciar } from "./utils/iniciador.js";
window.addEventListener('load', initAlta);
function initAlta() {
    iniciar();
    document.querySelector('#registrarse').addEventListener('click', alta);
}
function alta() {
    const id = document.querySelector('#id');
    const name = document.querySelector('#name');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const passwordBis = document.querySelector('#password-bis');
    if (comprobarFormulario([id, name, email, password, passwordBis]) && comprobarContrasenas([password, passwordBis])) {
        let idValue = id.value;
        let nameValue = name.value;
        let emailValue = email.value;
        let passwordValue = password.value;
        // Comprobamos que está disponible AJAX
        if (window.XMLHttpRequest) {
            var ajax = new XMLHttpRequest();
        }
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    let respuesta = ajax.responseText;
                    let mensaje = document.querySelector('#mensaje');
                    mensaje.style.textAlign = 'center';
                    if (respuesta == 0) {
                        mensaje.style.color = 'green';
                        mensaje.innerHTML = "El usuario se inserto correctamente";
                    }
                    else {
                        mensaje.style.color = 'red';
                        mensaje.innerHTML = "Error en la insercion";
                        let input = document.querySelector('#id');
                        input.focus();
                        input.parentElement.style.backgroundColor = 'red';
                    }
                }
            }
        };
        ajax.open("POST", "./php/alta.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&id=" + idValue + "&name=" + nameValue + "&email=" + emailValue + "&password=" + passwordValue);
    }
}
function comprobarContrasenas(inputs) {
    let correcto = true;
    const parrafo = document.querySelector(`#password-bis-error`);
    if (inputs[0].value !== inputs[1].value) {
        parrafo.style.display = 'block';
        parrafo.innerHTML = `Error las contraseñas deben ser iguales`;
        parrafo.parentElement.style.backgroundColor = "red";
        correcto = false;
    }
    else {
        parrafo.style.display = 'none';
        parrafo.parentElement.style.backgroundColor = "green";
    }
    return correcto;
}
