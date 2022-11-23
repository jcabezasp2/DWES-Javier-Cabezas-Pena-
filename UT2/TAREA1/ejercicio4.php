<?php

$mes_temp = "22, 25, 20, 28, 31, 28, 33, 25, 18, 24, 26, 23, 31, 36, 33, 28, 22, 23, 25, 25, 24, 33, 37, 35, 34, 28, 23, 25, 29, 33";
$temperaturas = explode(",", $mes_temp);
$temperaturas = array_map('trim', $temperaturas);


$suma = array_sum($temperaturas);
$totalElementos = count($temperaturas);
$media = $suma/$totalElementos;

asort($temperaturas);
$minimas = array_slice($temperaturas, 0, 5);
arsort($temperaturas);
$maximas = array_slice($temperaturas, 0, 5);


echo "La temperatura media fue ".$media."\n";
echo "Las 5 temperaturas mas altas fueron: ";
imprimir($maximas);
echo "\nLas 5 temperaturas mas bajas fueron: ";
imprimir($minimas);



function imprimir($parametro){
foreach($parametro as $elemento){
    echo $elemento." ";
}
}
?>