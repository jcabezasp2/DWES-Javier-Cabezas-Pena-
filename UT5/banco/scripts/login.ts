
window.addEventListener('load', principal);

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
}





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
