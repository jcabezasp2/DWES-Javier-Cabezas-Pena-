<?php


    function toFarenheit ($grados)
	{
		$far = (1.8*$grados) + 32;
		return $far;
	}

	echo "En Farenheit es ".toFarenheit(100);
?>