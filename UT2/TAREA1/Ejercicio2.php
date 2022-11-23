<?php

$miArray = array("abcd","abc","de","hjjj","g","wer");

function medir($parametro){

return strlen($parametro);

}

$tamanos = array_map('medir', $miArray);
$min = min($tamanos);
$max = max($tamanos);

echo "La cadena mas corta tiene una longitud de ".$min.". Y la mas larga ".$max.".";



?>