<?php

	$aletatorio1 = rand(0, 100);
    $aleatorio2 = rand(0,100);
    

    function calcularIMC ($peso, $altura)
	{
		$imc = $peso/pow($altura, 2);
		return $imc;
	}

	echo "El IMC es ".calcularIMC($aletatorio1, $aleatorio2);
?>