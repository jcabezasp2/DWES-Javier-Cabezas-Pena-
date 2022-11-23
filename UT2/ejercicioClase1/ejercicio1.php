<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';
if(isset($_POST['borrar'])){

  $_POST = array();
}


?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <legend>Datos personales</legend>
    <p>Escriba los datos siguientes:</p>
    <p>
    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre" id="name" value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];}?>" required>
    </p>
    <p>
    <label for="surname">Apellidos: </label>
    <input type="text" name="surname" id="surname" value="<?php if(isset($_POST['surname'])){echo $_POST['surname'];}?>" >
    </p>
    <p>
    <label for="fecha">Fecha nacimiento: </label>
    <input type="date" name="fecha" id="fecha" value="<?php if(isset($_POST['fecha'])){echo $_POST['fecha'];}?>" required>
    </p>
    <p>
    <input type="submit" name="enviar" value="Enviar">
    <input type="submit" name="borrar" value="Borrar">
    </p>
</fieldset>
</form>

<?php

if(isset($_POST['enviar'])){
  
    $arrayFecha = explode("-", $_POST["fecha"]);
    $anio = $arrayFecha[0];

    if($anio < 1980){
        echo "<p style='color:red'>Fecha errónea</p>";
    }elseif($anio >= 2000){
        echo "<p>".$_POST['nombre']." has nacido en el nuevo milenio</p>";
    }
    else{
        echo "<p>".$_POST['nombre']." has nacido en la decada de los ".substr($anio, 2, 1)."0</p>";
    }

    //echo "<a href='Ejercicio1.php'><p>Volver al formulario</p></a>";
}
 


?>


