
window.addEventListener('load', init);

function init() {
    let parrafo = document.createElement('p');
    let texto = document.createTextNode('Buenos dias');
    let parrafo2 = document.createElement('p');
    let texto2 = document.createTextNode('Esto es otro texto de prueba');
    parrafo2.appendChild(texto2);
    parrafo.appendChild(texto);
    

   // document.querySelector('body')?.appendChild(parrafo);
   // document.querySelector('body')?.appendChild(parrafo2);
          
} 

