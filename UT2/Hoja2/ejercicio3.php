<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';
if(isset($_POST['borrar'])){

    $_POST = array();
}
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>Datos para el calculo</h1>
    <label for="numero">Introduzca un numero:</label>
    <input type="number" name="numero" id="numero" min="1" value="<?php if(isset($_POST['numero'])){echo $_POST['numero'];}?>" required>
    <label for="tipo" require>Calcular:</label>
    <input type="submit" name="enviar" value="Calcular">
    <input type="submit" name="borrar" value="Borrar">
</fieldset>
</form>




<?php



if(isset($_POST['enviar'])){
    echo 'Numero '. $_POST['numero'];
    echo calcular($_POST['numero']);

}

function calcular($valor){
    $arrayResultado = count_chars($valor, 1);
    arsort($arrayResultado);
    foreach($arrayResultado as $key => $value){
        $resultado .="<p>";
        $resultado .=chr($key)." => ".$value." veces";
        $resultado .="</p>";
    }


    return $resultado;
}
 


?>


