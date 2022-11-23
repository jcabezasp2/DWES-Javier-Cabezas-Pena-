<?php


    function toCentigrados ($grados)
	{
		$cen = ($grados - 32) / 1.8;
		return $cen;
	}

	echo "En centigrados es ".toCentigrados(212);
?>