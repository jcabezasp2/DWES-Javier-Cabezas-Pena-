<?php

$letras = array("t", "r", "w", "a", "g", "m", "y", "f", "p", "d", "x", "b", "n", "j", "z", "s", "q", "v", "h", "l", "c", "k", "e");

function calcularLetra($numero){

    $resto = $numero % 23;

    return $GLOBALS['letras'][$resto];
}


echo calcularLetra(20207793);

?>