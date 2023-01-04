import { iniciar } from "./utils/iniciador.js";
window.addEventListener('load', initCrear);
var idCorrecto = true;
var numeroCorrecto = true;
function initCrear() {
    iniciar();
    insertarFecha();
    if (localStorage.getItem('usuario') == null || JSON.parse(localStorage.getItem('usuario'))._idCliente.trim() != '9999A') {
        let main = document.querySelector('main');
        main.innerHTML = "";
        let contenedor = document.createElement('div');
        contenedor.setAttribute('id', 'no-permitido');
        main.appendChild(contenedor);
        let i = document.createElement('i');
        i.setAttribute('class', "fa-sharp fa-solid fa-ban");
        contenedor.appendChild(i);
        let parrafo = document.createTextNode("Solo el administrador tiene acceso a esta pagina");
        contenedor.appendChild(parrafo);
        let logearse = document.createElement('button');
        logearse.innerText = "Login";
        logearse.addEventListener('click', () => { window.location.href = 'login.html'; });
        contenedor.appendChild(logearse);
    }
    document.querySelector('#numero').addEventListener('blur', comprobarNumero);
    document.querySelector('#id').addEventListener('blur', comprobarId);
    document.querySelector('#crearCuenta').addEventListener('click', crearCuenta);
}
function insertarFecha() {
    const fechaInput = document.querySelector('#date');
    let n = new Date();
    let y = n.getFullYear();
    let m = n.getMonth() + 1;
    let d = n.getDate();
    fechaInput.value = `${y}-${m < 10 ? '0' + m : m}-${d < 10 ? '0' + d : d}`;
}
function comprobarNumero() {
    let numeroCuenta = document.querySelector('#numero');
    let pattern = new RegExp(/^ES\d{4}$/);
    const parrafo = document.querySelector(`#numero-error`);
    if (pattern.test(numeroCuenta.value)) {
        if (window.XMLHttpRequest) {
            var ajax = new XMLHttpRequest();
        }
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    let respuesta = ajax.responseText;
                    if (respuesta == 1) {
                        console.log("Error, Sin permisos");
                        numeroCorrecto = false;
                    }
                    else if (respuesta == 2) {
                        parrafo.style.display = 'block';
                        parrafo.innerHTML = `Error, ya existe la cuenta`;
                        parrafo.parentElement.style.backgroundColor = "red";
                        //  console.log("Error, ya existe la cuenta");
                        numeroCorrecto = false;
                    }
                    else if (respuesta == 0) {
                        // console.log("Exito");
                        parrafo.style.display = 'block';
                        parrafo.innerHTML = ``;
                        parrafo.parentElement.style.backgroundColor = "green";
                        //console.log(respuesta);
                        numeroCorrecto = true;
                    }
                }
            }
        };
        ajax.open("POST", "./php/crear.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&accion=" + "existeNumeroCuenta" + "&cuenta=" + numeroCuenta.value);
    }
    else {
        console.log("ERROR, valor no valido");
        parrafo.style.display = 'block';
        parrafo.innerHTML = `Error, Valor no valido`;
        parrafo.parentElement.style.backgroundColor = "red";
        numeroCorrecto = false;
    }
}
function comprobarId() {
    let idCliente = document.querySelector('#id');
    let pattern = new RegExp(/^\d{4}[a-zA-z]{1}$/);
    const parrafo = document.querySelector(`#id-error`);
    if (pattern.test(idCliente.value)) {
        if (window.XMLHttpRequest) {
            var ajax = new XMLHttpRequest();
        }
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    let respuesta = ajax.responseText;
                    if (respuesta == 1) {
                        console.log("Error, Sin permisos");
                    }
                    else if (respuesta == 2) {
                        // console.log("Error, No existe el usuario");
                        parrafo.style.display = 'block';
                        parrafo.innerHTML = `Error, No existe el usuario`;
                        parrafo.parentElement.style.backgroundColor = "red";
                        idCorrecto = false;
                    }
                    else if (respuesta == 0) {
                        parrafo.innerHTML = ``;
                        parrafo.parentElement.style.backgroundColor = "green";
                        idCorrecto = true;
                        // console.log("ID valido");
                    }
                }
            }
        };
        ajax.open("POST", "./php/crear.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&accion=" + "existeId" + "&id=" + idCliente.value);
    }
    else {
        console.log("ERROR");
        parrafo.style.display = 'block';
        parrafo.innerHTML = `Error, Valor no valido`;
        parrafo.parentElement.style.backgroundColor = "red";
        idCorrecto = false;
    }
}
function crearCuenta(event) {
    event.preventDefault();
    comprobarNumero();
    comprobarId();
    console.log(idCorrecto);
    console.log(numeroCorrecto);
    const numeroCuenta = document.querySelector('#numero');
    const idTitular = document.querySelector('#id');
    const cantidad = document.querySelector('#cantidad');
    if (idCorrecto && numeroCorrecto) {
        if (window.XMLHttpRequest) {
            var ajax = new XMLHttpRequest();
        }
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    let respuesta = ajax.responseText;
                    if (respuesta == 0) {
                        document.querySelector('main').innerHTML = '';
                        let titulo = document.createElement('h3');
                        let texto = document.createTextNode(`La cuenta ${numeroCuenta.value} se ha creado correctamente`);
                        titulo.appendChild(texto);
                        titulo.style.textAlign = 'center';
                        document.querySelector('main').appendChild(titulo);
                        let segunda = document.createElement('h4');
                        let textoSegunda = document.createTextNode(`DATOS DE LA CUENTA`);
                        segunda.appendChild(textoSegunda);
                        segunda.style.textAlign = 'center';
                        document.querySelector('main').appendChild(segunda);
                        let tercera = document.createElement('p');
                        let textoTercera = document.createTextNode(`NUMERO DE LA CUENTA: ${numeroCuenta.value}`);
                        tercera.appendChild(textoTercera);
                        tercera.style.textAlign = 'center';
                        document.querySelector('main').appendChild(tercera);
                        let cuarta = document.createElement('p');
                        let textoCuarta = document.createTextNode(`ID DEL TITULAR: ${idTitular.value}`);
                        cuarta.appendChild(textoCuarta);
                        cuarta.style.textAlign = 'center';
                        document.querySelector('main').appendChild(cuarta);
                        let quinta = document.createElement('p');
                        let textoQuinta = document.createTextNode(`SALDO: ${cantidad.value}`);
                        quinta.appendChild(textoQuinta);
                        quinta.style.textAlign = 'center';
                        document.querySelector('main').appendChild(quinta);
                        let enlace = document.createElement('a');
                        enlace.setAttribute('href', 'index.html');
                        let simbolo = document.createElement('i');
                        simbolo.setAttribute('class', 'fa-solid fa-arrow-left');
                        let textoEnlace = document.createTextNode(`Inicio`);
                        enlace.appendChild(simbolo);
                        enlace.appendChild(textoEnlace);
                        enlace.style.display = 'block';
                        enlace.style.textAlign = 'center';
                        document.querySelector('main').appendChild(enlace);
                        //alert(`Creada con exito la cuenta ${numeroCuenta.value}`);
                    }
                    else {
                        console.log(respuesta);
                    }
                }
            }
        };
        ajax.open("POST", "./php/crear.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("&accion=" + "insertar" + "&numeroCuenta=" + numeroCuenta.value + "&idTitular=" + idTitular.value + "&cantidad=" + cantidad.value);
    }
}
