import Usuario from "./usuario.js";
import {iniciar} from "./utils/iniciador.js";
import {comprobarFormulario} from "./utils/form.js";
import { manejarVisor } from "./utils/visorConexion.js";
import { setCookie, getCookie } from "./utils/coockies.js";
window.addEventListener('load', initLogin);


<<<<<<< HEAD
function principal(): void {
   document.querySelector('#login')?.addEventListener('click', conectarse);


}

function valores(){
   const inputEmail = document.querySelector('#email') as HTMLInputElement;
   let emailValue = inputEmail.value as string;

   const inputPassword = document.querySelector('#password') as HTMLInputElement;
   let passwordValue = inputPassword.value as string;
   let resultado = `{"email": " ${emailValue}", "password": "${passwordValue}"}` as string;
   return   resultado;
}

/* function conectarse(){

   let text = valores();
    console.log(text);
    //text = JSON.parse(text);
    fetch('php/log.php', {
       method: 'POST',
       body: JSON.stringify(text)
    })
    .then(function(response) {
       if(response.ok) {
           console.log(response.text());
       } else {
           throw "Error en la llamada Ajax";
       } 
    })
    .then(function(texto) {
       console.log( texto);
    })
    .catch(function(err) {
       console.log(err);
    });

} */

/* function conectarse() {

   const formData = new FormData();

formData.append('username', 'abc123');
formData.append('avatar', 'Algo');
//console.table(formData);
fetch('php/log.php', {
  method: 'PUT',
  body: formData
})
  .then((response) => response.text())
  .then((result) => {
    console.log('Success:', result);
  })
  .catch((error) => {
    console.error('Error:', error);
  });
} */

function conectarse(){
   const data = valores();
   console.log(data);
   fetch('php/log.php', {
   method: 'POST',
   headers: {
      'Content-Type': 'application/json',
   },
   //body: JSON.stringify(data),
   body: data,
   })
   .then((response) => response.text())
   .then((data) => {
      console.log('Success:', data);
   })
   .catch((error) => {
      console.error('Error:', error);
   });
=======
function initLogin(): void {
   document.querySelector('#login').addEventListener('click', enviar)
   iniciar();
}
                
let ajax: XMLHttpRequest;

function enviar(){
    const email = document.querySelector('#email') as HTMLInputElement;
    const password = document.querySelector('#password') as HTMLInputElement;
    if(comprobarFormulario([email, password])){
        let emailValue = email.value;
    let passwordValue = password.value;
    // Comprobamos que está disponible AJAX
    if(window.XMLHttpRequest) {
    ajax = new XMLHttpRequest()
    }
    
    ajax.onreadystatechange=function(){
        if(ajax.readyState == 4) {
            if(ajax.status == 200) {
                //alert(ajax.responseText)
                login(ajax.response); 
            }
        }
    }

    ajax.open("POST","./php/log.php",true)
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
    ajax.send("&email=" + emailValue + "&password=" + passwordValue)
    }
    
>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
}

function login(respuesta: any){

<<<<<<< HEAD



//GET
/* function conectarse() {

   fetch('php/log.php/algo/algo2/algo3/algo4/algo5/algo6/algo7/algo8/algo9')
   .then(data => {
     console.log(data.text());
   })
} */



 async function existeUsuario(email: string) {
    let resultado: any;


    return resultado;
=======
    if(respuesta == 2){
        //Contraseña incorrecta
        let input :HTMLInputElement = document.querySelector('#password');
        input.focus();
        input.parentElement.style.backgroundColor ='red';
    }else if(respuesta == 3){
        //El usuario no existe
        let input :HTMLInputElement = document.querySelector('#email');
        input.focus();
        input.parentElement.style.backgroundColor ='red';
    }else{
        let id = respuesta.split(':')[0];
        let nombre = respuesta.split(':')[1];
        let usuario = new Usuario(id, nombre);
        setCookie('id', usuario.idCliente, 1);
        localStorage.setItem('usuario', JSON.stringify(usuario));
        window.location.href = 'index.html';      
    }

>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
}



<<<<<<< HEAD




/* let algo = getText("php/cuentas.php");

async function getText(file) {
let myObject = await fetch(file);
let myText = await myObject.json();
return myText;
}

console.log(algo); */


/*  const invoke = (name: string, workId: number, id: string, params: any = undefined) => {
   const url = 'php/log.php';
   return fetch(url, {
       method: 'POST',
       body: JSON.stringify(params ?? {}),
       headers: {
           'Content-Type': 'plain/text'
       }
   });
}
 */
=======

>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
