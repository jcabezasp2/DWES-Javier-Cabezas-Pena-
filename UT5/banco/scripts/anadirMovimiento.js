import { iniciar } from "./utils/iniciador.js";
window.addEventListener('load', initConsultar);
let ajax;
function initConsultar() {
    if (localStorage.getItem('usuario') == null || JSON.parse(localStorage.getItem('usuario'))._idCliente.trim() == '9999A') {
        let main = document.querySelector('main');
        main.innerHTML = "";
        let contenedor = document.createElement('div');
        contenedor.setAttribute('id', 'no-permitido');
        main.appendChild(contenedor);
        let i = document.createElement('i');
        i.setAttribute('class', "fa-sharp fa-solid fa-ban");
        contenedor.appendChild(i);
        let parrafo = document.createTextNode("Solo los usuarios logueados no administradores tienen acceso a esta pagina");
        contenedor.appendChild(parrafo);
        let logearse = document.createElement('button');
        logearse.innerText = "Login";
        logearse.addEventListener('click', () => { window.location.href = 'login.html'; });
        contenedor.appendChild(logearse);
    }
    iniciar();
    buscarConsultar();
    document.querySelector('#insertar').addEventListener('click', insertar);
}
async function buscarConsultar() {
    // Comprobamos que está disponible AJAX
    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //alert(ajax.responseText)
                OpcionesSelect(JSON.parse(ajax.response));
                console.log(ajax.responseText);
                //mostrarTabla(ajax.response); 
            }
        }
    };
    ajax.open("POST", "./php/anadirMovimiento.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&accion=" + "cuentas");
}
function OpcionesSelect(datos) {
    datos = JSON.parse(datos);
    const select = document.querySelector('#cuenta');
    datos.cuentas.forEach(element => {
        let option = document.createElement("option");
        option.setAttribute('value', element.num_cta);
        option.appendChild(document.createTextNode(`${element.num_cta}`));
        select.appendChild(option);
    });
}
function insertar(evento) {
    evento.preventDefault();
    const error = document.querySelector('#cantidad-error');
    const inputCantidad = document.querySelector('#cantidad');
    const inputIngreso = document.querySelector('#ingreso');
    const inputReintegro = document.querySelector('#reintegro');
    const inputNumero = document.querySelector('#cuenta');
    let codigoCuenta = inputNumero.value;
    let cantidad = inputCantidad.valueAsNumber;
    let tipo = inputIngreso.checked ? inputIngreso.value : inputReintegro.value;
    if (cantidad == undefined || Number.isNaN(cantidad) || cantidad == null) {
        error.innerText = `Campo obligatorio`;
        error.style.textAlign = "center";
        error.parentElement.style.backgroundColor = "red";
    }
    else {
        error.innerText = ``;
        error.parentElement.style.backgroundColor = "darkgrey";
        enviarMovimiento(cantidad, tipo, codigoCuenta);
    }
}
function enviarMovimiento(cantidad, tipo, codigoCuenta) {
    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                let objetivo = document.querySelector('#resultado');
                objetivo.innerText = '';
                let texto = document.createTextNode(`El saldo de la cuenta es ${ajax.responseText}€`);
                objetivo.appendChild(texto);
                objetivo.style.color = 'green';
                objetivo.style.textAlign = 'center';
                console.log(ajax.responseText);
            }
        }
    };
    ajax.open("POST", "./php/anadirMovimiento.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&accion=" + "insertarMovimiento" + "&cantidad=" + cantidad + "&tipo=" + tipo + "&codigoCuenta=" + codigoCuenta);
}
