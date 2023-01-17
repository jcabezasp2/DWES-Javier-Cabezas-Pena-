import {iniciar} from "./utils/iniciador.js";
window.addEventListener('load', initEliminar);
let ajax: XMLHttpRequest;

function initEliminar() :void {
    if(localStorage.getItem('usuario') == null || JSON.parse(localStorage.getItem('usuario'))._idCliente.trim() != '9999A' ){
        let main = document.querySelector('main');
        main.innerHTML= "";
        
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
        logearse.addEventListener('click', () => {window.location.href = 'login.html'})
        contenedor.appendChild(logearse);
    }
        iniciar();
        buscarOpciones();
        document.querySelector('#borrar').addEventListener('click', borrar);
}

async function buscarOpciones() :Promise<void> {
    
    // Comprobamos que está disponible AJAX
    if(window.XMLHttpRequest) {
    ajax = new XMLHttpRequest()
    }
    
    ajax.onreadystatechange=function(){
        if(ajax.readyState == 4) {
            if(ajax.status == 200) {
                //console.log(ajax.responseText);
                OpcionesSelect(JSON.parse(ajax.response));
            }
        }
    }

    ajax.open("POST","./php/eliminar.php",true)
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
    ajax.send("&accion=" + "cuentas")

}

function OpcionesSelect(datos :any) :void {

    datos = JSON.parse(datos);
    const select :HTMLSelectElement = document.querySelector('#cuenta');
    select.innerHTML = '';
    datos.cuentas.forEach(element  => {
        let option : HTMLOptionElement = document.createElement("option");
        option.setAttribute('value', element.num_cta);
        option.appendChild(document.createTextNode(element.num_cta));
        select.appendChild(option);
       
    });
}

async function borrar(evento :Event) :Promise<void> {
    evento.preventDefault();
    
    const select :HTMLSelectElement = document.querySelector('#cuenta');
    let cuenta :string = select.value;
    if(window.XMLHttpRequest) {
        ajax = new XMLHttpRequest()
        }
        
        ajax.onreadystatechange=function(){
            if(ajax.readyState == 4) {
                if(ajax.status == 200) {
                    console.log(ajax.responseText);
                    let respuesta = ajax.response;
                    const objetivo :HTMLDivElement = document.querySelector('#resultado');
                   if(respuesta == 0){
                        objetivo.innerHTML = `Borrada la cuenta: ${cuenta}`;
                        objetivo.style.textAlign = "center";
                        objetivo.style.color = "green";
                        buscarOpciones();
                   }else{
                    objetivo.innerHTML = `Error no se pudo borrar la cuenta: ${cuenta}`;
                    objetivo.style.textAlign = "center";
                    objetivo.style.color = "red";
                    }
                }
            }
        }
    
        ajax.open("POST","./php/eliminar.php",true)
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
        ajax.send("&accion=" + "borrar" + "&cuenta=" + cuenta);

}