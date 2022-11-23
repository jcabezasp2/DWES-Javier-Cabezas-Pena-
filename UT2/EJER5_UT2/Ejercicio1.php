<?php
echo '<link rel="stylesheet" href="estilo3.css">';

function calcularLetra($dni){

    
		$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
		$letra=$dni%23;
		//substr() devuelve el caracter desde la posición dada por $letra
		$letra_correcta = substr($letras_validas, $letra, 1);	
	return $letra_correcta;
}
   
 //var_dump($_POST);
  $letra =  calcularLetra($_POST["numero"]);
	echo "<body>";
	echo "<h2>Calculo letra NIF - Resultado</h2>";
	if(strlen($_POST["numero"])<8) {
		echo "DNI demasiado corto.";

	}else{
		echo "La letra del DNI es ".$letra;
	}
    

    echo "<a href='Ejercicio1.html'><p>Volver al principio</p></a>";

	echo "</body>";
?>