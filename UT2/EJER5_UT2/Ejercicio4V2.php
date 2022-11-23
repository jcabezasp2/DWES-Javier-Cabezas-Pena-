<?php
echo '<link rel="stylesheet" href="estilo3.css">';
//var_dump($_POST);
$resultado;



if(isset($_POST['numero'])){
    if($_POST['type'] == "celsius"){
        $resultado = toFarenheit($_POST['numero']);
        }else{
            $resultado = toCentigrados($_POST['numero']);
        }

    echo "<h1>CONVERTIDOR DE TEMPERATURAS CELSIUS / FARENHEIT (RESULTADO)</h1>";
    echo "<p>".$resultado."</p>";
    echo "<a href='Ejercicio4V2.php'><p>Volver al formulario</p></a>";
}else {
    echo "<body>
    <h1>CONVERTIDOR DE TEMPERATURAS CELSIUS / FARENHEIT (FORMULARIO)</h1>
    <form action='Ejercicio4V2.php' method='post'>
        <fieldset>
            <legend>Formulario</legend>
            <p>Escriba una temperatura en grados Celsius o Farenheit y la convetire a la otra unidad (Farenheit o Celsius)</p>

            <p>
                <label for='numero'>Temperatura: </label>
                <input type='number' name='numero' step='0.1' required>
                <select name='type'>
                    <option value='celsius'>Celsius</option>
                    <option value='farenheit'>Farenheit</option>
                </select>
            </p>
            <p>
                <input type='submit' name='enviar' value='Convertir'>
                <input type='reset' value='Borrar'>
            </p>
        </fieldset>
    </form>
</body>";
}


   





    







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