<link rel="stylesheet" href="estilo6.css">
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
        <option value="1">Menos de 20 años</option>
        <option value="2">Entre 20 y 39 años</option>
        <option value="3">Entre 40 y 59 años</option>
        <option value="4">60 años o más</option>
    </select><br />
    
	<label>Peso:</label>
	<input type="text" name="peso" size="6" maxlength="5" value="<?php if(isset($_POST['peso'])){echo $_POST['peso'];}?>">kg<br />
    
	<label>Sexo:</label>
            <input type="radio" name="sexo" value="hombre" <?php  echo mantenerRadio("sexo", "hombre")     ?>/>Hombre 
            <input type="radio" name="sexo" value="mujer" <?php  echo mantenerRadio("sexo", "mujer")     ?>/>Mujer<br />
			
	<label>FechaNacimiento:</label>
	<input type="date"  name="fecha" value="<?php if(isset($_POST['fecha'])){echo $_POST['fecha'];}?>"></br>

	<label>Zodiaco:</label>
	<input type="text"  name="zodiaco" value="<?php echo signo_zodiaco($_POST['fecha'])?>"/></br>
    
	<label>Estado Civil:</label>
    <input type="radio" name="estadoCivil" value="soltero" <?php  echo mantenerRadio("estadoCivil", "soltero")     ?>/> Soltero
    <input type="radio" name="estadoCivil" value="casado" <?php  echo mantenerRadio("estadoCivil", "casado")     ?>/> Casado
    <input type="radio" name="estadoCivil" value="otro" <?php  echo mantenerRadio("estadoCivil", "otro")     ?>/> Otro<br />
   
   <label>Aficiones:</label>
    <input type="checkbox"  name="aficiones[]" value="cine" <?php echo mantenerCheckbox("aficiones", "cine")?>/> Cine
    <input type="checkbox"  name="aficiones[]" value="literatura" <?php echo mantenerCheckbox("aficiones", "literatura")?>/> Literatura
    <input type="checkbox"  name="aficiones[]" value="tebeos" <?php echo mantenerCheckbox("aficiones", "tebeos")?>/> Tebeos
    <input type="checkbox"  name="aficiones[]" value="deporte" <?php echo mantenerCheckbox("aficiones", "deporte")?>/> Deporte
    <input type="checkbox"  name="aficiones[]" value="musica" <?php echo mantenerCheckbox("aficiones", "musica")?>/> Música
    <input type="checkbox"  name="aficiones[]" value="television" <?php echo mantenerCheckbox("aficiones", "television")?>/> Televisión
    
    <p >
    <input type="submit" value="Enviar" name="enviar"/> 
    <input type="reset" value="Borrar" name="Reset" /></p>
  </fieldset>
</form>


<?php  

function mantenerRadio($nombre, $valor){

$check = "";
if(isset($_POST[$nombre]) && $_POST[$nombre] == $valor){
    $check = "checked";
}
return $check;


}




function signo_zodiaco($fecha){

/*     if(isset($_POST['enviar'])){
        $fecha = $_POST['fecha'];
    } */

list ( $ano, $mes, $dia ) = explode ( "-", $fecha );
   
   if ( ( $mes == 1 && $dia > 19 )  || ( $mes == 2 && $dia < 19 ) )  
   { $zodiaco = "Acuario"; }
   elseif ( ( $mes == 2 && $dia > 18 )  || ( $mes == 3 && $dia < 21 ) )  
   { $zodiaco = "Piscis"; } 
   elseif ( ( $mes == 3 && $dia > 20 )  || ( $mes == 4 && $dia < 20 ) )  
   { $zodiaco = "Aries"; } 
   elseif ( ( $mes == 4 && $dia > 19 )  || ( $mes == 5 && $dia < 21 ) )  
   { $zodiaco = "Tauro"; } 
   elseif ( ( $mes == 5 && $dia > 20 )  || ( $mes == 6 && $dia < 21 ) )  
   { $zodiaco = "Geminis"; } 
   elseif ( ( $mes == 6 && $dia > 20 )  || ( $mes == 7 && $dia < 23 ) )  
   { $zodiaco = "Cancer"; } 
   elseif ( ( $mes == 7 && $dia > 22 )  || ( $mes == 8 && $dia < 23 ) )  
   { $zodiaco = "Leo"; } 
   elseif ( ( $mes == 8 && $dia > 22 )  || ( $mes == 9 && $dia < 23 ) )  
   { $zodiaco = "Virgo"; } 
   elseif ( ( $mes == 9 && $dia > 22 )  || ( $mes == 10 && $dia < 23 ) ) 
   { $zodiaco = "Libra"; } 
   elseif ( ( $mes == 10 && $dia > 22 ) || ( $mes == 11 && $dia < 22 ) ) 
   { $zodiaco = "Escorpio"; } 
   elseif ( ( $mes == 11 && $dia > 21 ) || ( $mes == 12 && $dia < 22 ) ) 
   { $zodiaco = "Sagitario"; } 
   elseif ( ( $mes == 12 && $dia > 21 ) || ( $mes == 1 && $dia < 20 ) )  
   { $zodiaco = "Capricornio"; } 

   return $zodiaco;
}


    function mantenerCheckbox($nombre, $valor){
        $check = "";
        if(isset($_POST[$nombre])){
            $afic = $_POST[$nombre];
            if(in_array($valor, $afic) != false)
            $check = "checked";
        }

        return $check;
    }
   ?>