
window.addEventListener('load', principal);

function principal(): void {
   document.querySelector('#login').addEventListener('click', conectarse);


}

function valores(){
   const inputEmail = document.querySelector('#email') as HTMLInputElement;
   let emailValue = inputEmail.value;

   const inputPassword = document.querySelector('#password') as HTMLInputElement;
   let passwordValue = inputPassword.value;
   return   `"{"email": " ${emailValue}", "password": "${passwordValue}"}"`;
}

function conectarse(): void{
   //let email :<HTMLInputElement>;

   // const data = [];
   //let text = valores();
    let text = '{ "name": "John", "age": 22 }';
    text = JSON.parse(text);
    fetch('php/log.php', {
       method: 'POST',
       body: text
    })
    .then(function(response) {
       if(response.ok) {
           return response.text()
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


}


 async function existeUsuario(email: string) {
    let resultado: any;


    return resultado;
}







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
