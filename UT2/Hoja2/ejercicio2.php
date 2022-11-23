<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';

?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>Datos para el calculo</h1>
    <label for="numero">Introduzca un numero:</label>
    <input type="number" name="numero" id="numero" min="1" value="<?php if(isset($_POST['numero'])){echo $_POST['numero'];}?>" required>
    <label>Calcular:</label>
    <input type="radio" name="tipo" value="factorial" <?php  echo mantenerRadio("tipo", "factorial")     ?>/> Factorial
    <input type="radio" name="tipo" value="sumatoria" <?php  echo mantenerRadio("tipo", "sumatoria")     ?>/> Sumatoria
    <input type="submit" name="enviar" value="Calcular">
    <input type="submit" name="borrar" value="Borrar">
</fieldset>
</form>
<?php

if(isset($_POST['enviar'])){
  if(!isset($_POST['tipo'])){
    echo '<p><strong>ERROR, Es necesario elegir una opcion</strong></p>';
  }elseif($_POST['tipo'] == "sumatoria"){
    $resultadoSumatoria = sumatorio($_POST['numero']);
    echo '<p><strong>La sumatoria de '.$_POST['numero'].' es '.$resultadoSumatoria.'</strong></p>';
  }else{

    $resultadoFactorial = factorial($_POST['numero']);
    echo '<p><strong>El factorial de '.$_POST['numero'].' es '.$resultadoFactorial.'</strong></p>';


  }
}
 

  function sumatorio($valor){
    $resultado = 0;
    for($i = 1; $i <= $valor; $i++){

      $resultado += $i;

    }

    return $resultado;
  }


  function factorial($valor){
    $resultado = 1;
    for($i = 1; $i <= $valor; $i++){

      $resultado *= $i;

    }

    return $resultado;
  }

?>


