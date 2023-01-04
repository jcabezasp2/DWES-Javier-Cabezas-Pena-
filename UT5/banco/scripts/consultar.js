import { iniciar } from "./utils/iniciador.js";
window.addEventListener('load', initConsultar);
let ajax;
let codigoCuenta;
function initConsultar() {
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
    iniciar();
    buscarConsultar();
    document.querySelector('#buscar').addEventListener('click', buscarDatos);
    document.querySelector('#anadir').addEventListener('click', anadirMovimiento);
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
                //console.log(ajax.responseText);
                //mostrarTabla(ajax.response); 
            }
        }
    };
    ajax.open("POST", "./php/consultar.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&accion=" + "clientes");
}
function OpcionesSelect(datos) {
    datos = JSON.parse(datos);
    const select = document.querySelector('#titular');
    datos.clientes.forEach(element => {
        let option = document.createElement("option");
        option.setAttribute('value', element.num_cta);
        option.appendChild(document.createTextNode(`${element.nombre} - ${element.num_cta}`));
        select.appendChild(option);
    });
}
async function buscarDatos(event) {
    event.preventDefault();
    let idUsuario = document.querySelector('#titular');
    let cuenta = idUsuario.value;
    // Comprobamos que está disponible AJAX
    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //alert(ajax.responseText)
                //console.log(ajax.response);
                mostrarDatos(JSON.parse(ajax.response));
            }
        }
    };
    ajax.open("POST", "./php/consultar.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&accion=" + "datosCuenta" + "&cuenta=" + cuenta);
}
function mostrarDatos(datos) {
    datos = JSON.parse(datos);
    const contenedor = document.querySelector('#datosCuenta');
    contenedor.innerHTML = '';
    if (datos.datosCuenta[0].num_cta == undefined) {
        let error = document.createElement('p');
        error.innerText = `El usuario seleccionado no tiene ninguna cuenta`;
        error.style.textAlign = "center";
        error.style.color = "red";
        contenedor.appendChild(error);
    }
    else {
        codigoCuenta = datos.datosCuenta[0].num_cta;
        let primera = document.createElement("p");
        primera.innerText = `Titular: ${datos.datosCuenta[0].nombre}`;
        primera.style.textAlign = "center";
        contenedor.appendChild(primera);
        let segunda = document.createElement("p");
        segunda.innerText = `Saldo: ${datos.datosCuenta[0].saldo}`;
        segunda.style.textAlign = "center";
        contenedor.appendChild(segunda);
        let tercera = document.createElement("p");
        tercera.innerText = `Nº Cuenta: ${datos.datosCuenta[0].num_cta}`;
        tercera.style.textAlign = "center";
        contenedor.appendChild(tercera);
        let tabla = document.createElement('table');
        tabla.style.border = '1px solid white';
        let titulos = document.createElement('tr');
        let fecha = document.createElement('th');
        fecha.innerText = 'Fecha';
        titulos.appendChild(fecha);
        let tipo = document.createElement('th');
        tipo.innerText = 'Tipo';
        titulos.appendChild(tipo);
        let importe = document.createElement('th');
        importe.innerText = 'Importe';
        titulos.appendChild(importe);
        tabla.appendChild(titulos);
        for (let i = 1; i < datos.datosCuenta.length; i++) {
            let fila = document.createElement('tr');
            let fecha = document.createElement('td');
            fecha.innerText = datos.datosCuenta[i].fecha_mov;
            fila.appendChild(fecha);
            let tipo = document.createElement('td');
            tipo.innerText = datos.datosCuenta[i].tipo_mov;
            fila.appendChild(tipo);
            let importe = document.createElement('td');
            importe.innerText = datos.datosCuenta[i].importe;
            fila.appendChild(importe);
            tabla.appendChild(fila);
        }
        contenedor.appendChild(tabla);
        let div = document.querySelector('#anadirMovimiento');
        div.style.display = 'block';
    }
}
function anadirMovimiento(evento) {
    evento.preventDefault();
    const error = document.querySelector('#cantidad-error');
    const inputCantidad = document.querySelector('#cantidad');
    const inputIngreso = document.querySelector('#ingreso');
    const inputReintegro = document.querySelector('#reintegro');
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
    ajax.open("POST", "./php/consultar.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("&accion=" + "insertarMovimiento" + "&cantidad=" + cantidad + "&tipo=" + tipo + "&codigoCuenta=" + codigoCuenta);
}
