
window.addEventListener('load', principal);

function principal(): void {
   document.querySelector('#login').addEventListener('click', conectarse)
    
}


function conectarse(): void{
    let email: HTMLInputElement;
    email = document.querySelector('#email');

    let password: HTMLInputElement;
    password = document.querySelector('#password');


    console.log(login(email.value, password.value));
}

 async function login(email: string, password: string) {
    let resultado: any;
    resultado = await fetch('./php/log.php');
    resultado = await resultado.text();
    return resultado;
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