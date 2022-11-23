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
    <p>
    <label for="hijos">Numero de hijos:</label>
    <input type="number" name="hijos" id="hijos" min="1" value="<?php if(isset($_POST['hijos'])){echo $_POST['hijos'];}?>" required>
    </p>
    <p>
    <label for="hijosEscolar">Numero de hijos en edad escolar:</label>
    <input type="number" name="hijosEscolar" id="hijosEscolar" min="0" value="<?php if(isset($_POST['hijosEscolar'])){echo $_POST['hijosEscolar'];}?>" required>
    <small>entre 6 y 18 años</small>
    </p>
    <p>
    <input type="checkbox"  name="madreViuda[]" value="viuda" <?php echo mantenerCheckbox("madreViuda", "viuda")?>/> La madre de familia es viuda
    </p>
    <input type="submit" name="enviar" value="Calcular">
    <input type="submit" name="borrar" value="Borrar">
</fieldset>
</form>




<?php

if(isset($_POST['enviar'])){
  
echo "Recibira la cantidad de ".calcular($_POST)."€ al mes";

}

function calcular($valores){

    $resultado = 0;

    if($valores['hijos'] <= 2){
        $resultado += 1200;
    }elseif($valores['hijos'] >= 3 && $valores['hijos'] <= 5){
        $resultado += 1550;
    }elseif($valores['hijos'] >= 6){
        $resultado += 1700;
    }

    $resultado += ($valores['hijosEscolar'] * 100);

    $resultado += (isset($valores['madreViuda'])?  200: 0);
    

    return $resultado;
}
 


?>


