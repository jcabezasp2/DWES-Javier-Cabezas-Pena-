<?php
echo '<link rel="stylesheet" href="estilo3.css">';
//var_dump($_POST);
$resultado;

if($_POST['type'] == "celsius"){
    $resultado = toFarenheit($_POST['numero']);
    }else{
        $resultado = toCentigrados($_POST['numero']);
    }


echo "<body>";
echo "<h1>CONVERTIDOR DE TEMPERATURAS CELSIUS / FARENHEIT (RESULTADO)</h1>";
echo "<p>".$resultado."</p>";
echo "<a href='Ejercicio4.html'><p>Volver al formulario</p></a>";


echo "</body>";


function toFarenheit ($grados)
{
    $far = (1.8*$grados) + 32;
    return $grados." ºC son ".$far." ºF";
}


function toCentigrados ($grados)
{
    $cen = ($grados - 32) / 1.8;
    return  $grados." ºF son ".$cen." ºC";
}




?>