

export function comprobarFormulario(inputs :Array<HTMLInputElement>) :boolean {

    let correcto = true;
    inputs.forEach(input => {
        const parrafo = document.querySelector(`#${input.id}-error`) as any;
        if(!input.checkValidity()){
            parrafo.innerHTML = `Error valor invalido`;
            parrafo.parentElement.style.backgroundColor = "red";
            correcto = false;
        }else{
            parrafo.style.display = 'none';
            parrafo.parentElement.style.backgroundColor = "green";
        }
    });

    return correcto;
    
}



