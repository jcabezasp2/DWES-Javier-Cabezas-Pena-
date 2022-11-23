<?php

	function calcularIMC ($peso, $altura)
	{
		$imc = $peso/pow($altura, 2);
		return $imc;
	}

	echo "El IMC es ".calcularIMC(87, 178);
?>