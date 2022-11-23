


<link rel="stylesheet" href="estilo6.css">

<?php
include 'funciones.php';
if(!isset($_POST['enviar']))
{
?>
 <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <legend>Datos personales</legend>
    <p>Escriba los datos siguientes:</p>

    <label>Nombre:
    <input type="text" name="nombre" maxlength="20" value="<?php 
    if(isset($_POST['nombre']))
        {echo $_POST['nombre'];}
      ?>">
    </label></br>
    
	<label>Apellidos:</label>
    <input type="text" name="apellidos" size="20" maxlength="20" value="<?php if(isset($_POST['apellidos'])){echo $_POST['apellidos'];}?>">
    <label>Edad:</label>

    <select name="edad">
        <option selected="selected"></option>
        <option value="menos de 20 años">Menos de 20 años</option>
        <option value="entre 20 y 39 años">Entre 20 y 39 años</option>
        <option value="entre 40 y 59 años">Entre 40 y 59 años</option>
        <option value="60 años o más">60 años o más</option>
    </select><br />
    
	<label>Peso:</label>
	<input type="number" step="any" min="0" name="peso"  value="<?php if(isset($_POST['peso'])){echo $_POST['peso'];}?>">kg<br />
    
	<label>Sexo:</label>
            <input type="radio" name="sexo" value="hombre" <?php  echo mantenerRadio("sexo", "hombre")     ?>/>Hombre 
            <input type="radio" name="sexo" value="mujer" <?php  echo mantenerRadio("sexo", "hombre")     ?>/>Mujer<br />
			
	<label>FechaNacimiento:</label>
	<input type="date"  name="fecha" value="<?php if(isset($_POST['fecha'])){echo $_POST['fecha'];}?>"></br>

    
	<label>Estado Civil:</label>
    <input type="radio" name="estadoCivil" value="soltero" /> Soltero
    <input type="radio" name="estadoCivil" value="casado" /> Casado
    <input type="radio" name="estadoCivil" value="otro" /> Otro<br />
   
   <label>Aficiones:</label>
    <input type="checkbox"  name="aficiones[]" value="cine" /> Cine
    <input type="checkbox"  name="aficiones[]" value="literatura" /> Literatura
    <input type="checkbox"  name="aficiones[]" value="tebeos" /> Tebeos
    <input type="checkbox"  name="aficiones[]" value="deporte" /> Deporte
    <input type="checkbox"  name="aficiones[]" value="musica" /> Música
    <input type="checkbox"  name="aficiones[]" value="television" /> Televisión
    
    <p >
    <input type="submit" value="Enviar" name="enviar"/> 
    <input type="reset" value="Borrar" name="Reset" /></p>
  </fieldset>
</form>

<?php
}else{

var_dump($_POST);

echo (strlen($_POST['nombre'] == 0)? "<p>Su nombre es ".$_POST['nombre'] : "<p class='aviso'>No ha introducido su nombre")."</p>";
echo (strlen($_POST['apellidos'])? "<p>Sus apellidos son ".$_POST['apellidos'] : "<p class='aviso'>No ha introducido sus apellidos")."</p>";
echo (strlen($_POST['edad'])? "<p>Su edad es ".$_POST['edad'] : "<p class='aviso'>No ha introducido su edad")."</p>";
echo (strlen($_POST['peso'])? "<p>Su peso es ".$_POST['peso'] : "<p class='aviso'>No ha introducido su peso")."</p>";
echo (strlen($_POST['fecha'])? "<p>Su fecha de nacimiento es ".$_POST['fecha'] : "<p class='aviso'>No ha introducido su fecha de nacimiento")."</p>";
echo (isset($_POST['sexo'])? "<p>Su sexo es ".$_POST['sexo'] : "<p class='aviso'>No ha introducido su sexo")."</p>";
echo (isset($_POST['estadoCivil'])? "<p>Su estado civil es ".$_POST['estadoCivil'] : "<p class='aviso'>No ha introducido su estado civil")."</p>";

if(isset($_POST['aficiones'])){
    echo "<p>";
    foreach($_POST['aficiones'] AS $value){
        echo $value;
        if($value != end($_POST['aficiones'])){
            echo ", ";
        }
       
    }

    echo "</p>";
}else{
    echo "<p class='aviso'>No ha introducido ningua aficion</p>";
}
echo "<a href='Ejercicio2.php'><p>Volver al formulario</p></a>";
}
?>
