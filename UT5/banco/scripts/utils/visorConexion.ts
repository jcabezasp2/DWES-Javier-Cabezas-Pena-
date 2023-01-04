import Usuario from "../usuario.js";

/* <p>USUARIO</p>
<p id="id-usuario">Lorem</p>
<p>TIEMPO DE CONEXION</p>
<p id="cronometro">00:00</p> */


export function manejarVisor(){
    if(localStorage.getItem('usuario') != null) {
        crearDivConConexion();
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        document.querySelector('#id-usuario').innerHTML = usuario._nombreCliente;
        let horaConexion :Date = new Date(usuario._horaConexion);
        setInterval(function () {
            document.querySelector('#cronometro').innerHTML = temporizador(horaConexion);
        }, 1000);
    }else{
        document.querySelector('#datos-conexion').innerHTML = 'No conectado';
    }
}


function temporizador(hora : Date) :string{
    let tiempoPasado = calcularTiempoPasado(hora)
    tiempoPasado /= 1000;
    let minutos = Math.trunc(tiempoPasado / 60);
    let segundos = Math.trunc(tiempoPasado % 60);

    return (minutos <9? "0":"") + minutos + ":" + (segundos <9? "0":"") +  segundos;
}

function calcularTiempoPasado(horaInicio :Date){
    let horaActual= new Date();       
    let tiempoPasado = horaActual.getTime() - horaInicio.getTime();
    return tiempoPasado;
}

function crearDivConConexion(){
    const div = document.querySelector('#datos-conexion');
    div.innerHTML = '';
    let primeraLinea = document.createElement('h5');
    primeraLinea.appendChild(document.createTextNode('USUARIO'));
    div.appendChild(primeraLinea);

    let segundaLinea = document.createElement('p');
    segundaLinea.setAttribute('id', 'id-usuario');
    div.appendChild(segundaLinea);
    
    let terceraLinea = document.createElement('h5');
    terceraLinea.appendChild(document.createTextNode('Tiempo de conexion'));
    div.appendChild(terceraLinea);
    
    let cuartaLinea = document.createElement('p');
    cuartaLinea.setAttribute('id', 'cronometro');
    div.appendChild(cuartaLinea);
}
