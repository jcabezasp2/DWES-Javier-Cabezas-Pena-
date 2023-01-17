<<<<<<< HEAD
"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
=======
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
>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
            }
        };
        ajax.open("POST", "./php/log.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&email=" + emailValue + "&password=" + passwordValue);
    }
<<<<<<< HEAD
};
window.addEventListener('load', principal);
function principal() {
    var _a;
    (_a = document.querySelector('#login')) === null || _a === void 0 ? void 0 : _a.addEventListener('click', conectarse);
}
function valores() {
    var inputEmail = document.querySelector('#email');
    var emailValue = inputEmail.value;
    var inputPassword = document.querySelector('#password');
    var passwordValue = inputPassword.value;
    var resultado = "{\"email\": \" ".concat(emailValue, "\", \"password\": \"").concat(passwordValue, "\"}");
    return resultado;
}
function conectarse() {
    var data = valores();
    console.log(data);
    fetch('php/log.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
        .then(function (response) { return response.text(); })
        .then(function (data) {
        console.log('Success:', data);
    })["catch"](function (error) {
        console.error('Error:', error);
    });
}
function existeUsuario(email) {
    return __awaiter(this, void 0, void 0, function () {
        var resultado;
        return __generator(this, function (_a) {
            return [2, resultado];
        });
    });
=======
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
>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
}
