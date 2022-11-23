<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';

if(!isset($_POST['enviar']) && !isset($_POST['enviar2']))
{
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>TABLA CON CASILLAS DE VERIFICACION</h1>
    <label for="tamano">Tamaño:</label>
    <input type="number" name="tamano" id="tamano" min="1" required>
    <input type="submit" name="enviar" value="Dibujar">
</fieldset>
</form>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<?php


}elseif(isset($_POST['enviar']) || isset($_POST['enviar2'])){

    ?>
    <h1>TABLA CON CASILLAS DE VERIFICACION - PASO 1</h1>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
    <fieldset>
    
    <?php

    $contador = 1;

    if(!isset($_POST['enviar2'])){
        $tamanoParametro = $_POST['tamano'];
    }else{
        $tamanoParametro = $_POST['primerParametro'];
    }
    
    echo "<table>";
    for($i = 0; $i < $tamanoParametro; $i++){
        echo "<tr>";

        for($x = 0; $x < $tamanoParametro; $x++){
            echo '<td><input type="checkbox" name="selected[]"'.mantenerCheckbox("selected", $contador).' value="'.$contador.'">'.$contador. '.</td>';
            $contador++;
        }
        echo "</tr>";
    }
    echo "</table>";

?>
    <input type="hidden" name="primerParametro" value="<?php echo $tamanoParametro  ?>">
    <input type="submit" name="enviar2" value="Contar">
    <input type="submit" name="borrar" value="Borrar">
</form>
<?php


if(isset($_POST['enviar2'])){
    echo "<h1>TABLA CON CASILLAS DE VERIFICACION - PASO 2</h1>";
    echo "<p>Has marcado ".count($_POST['selected'])." casillas de un total de ".($_POST['primerParametro']) * $_POST['primerParametro'].":";
    foreach($_POST['selected'] as $item){
        echo $item." " ;
    }
    echo "</p>";
}



}

?>