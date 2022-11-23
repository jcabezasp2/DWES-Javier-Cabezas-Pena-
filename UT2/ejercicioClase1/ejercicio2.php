<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';
if(isset($_POST['borrar'])){

  $_POST = array();
}
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<fieldset>
    <legend>Sacar iniciales de frase</legend>
    <p>Escriba la frase:</p>
    <p>
    <label for="frase">Frase: </label>
    <input type="text" name="frase" id="frase" value="<?php if(isset($_POST['frase'])){echo $_POST['frase'];}?>" required>
    </p>
    <p>
    <input type="submit" name="enviar" value="Enviar">
    <input type="submit" name="borrar" value="Borrar">
    </p>
</fieldset>
</form>


<?php

if(isset($_POST['enviar'])){

    $cantidadcaracteres =  strlen($_POST["frase"]);
    echo "<p> Numero de caracteres en el texto= ". $cantidadcaracteres."</p>";
    
    $cantidadPalabras = count(explode(" ", $_POST["frase"]));
    echo "<p> Numero de palabras en el texto= ". $cantidadPalabras."</p>";

    $arrayfrase= explode(" ", $_POST["frase"]);
    $resultado = devuelveIniciales($arrayfrase);
    echo "<p>Las siglas de: <strong>". $_POST["frase"]."</strong> son ".$resultado."</p>";
}


function devuelveIniciales($parametro){
    $resultado = '';

    foreach($parametro as $item){
       $resultado .= substr($item, 0, 1);
    }

    return $resultado;
}


?>


