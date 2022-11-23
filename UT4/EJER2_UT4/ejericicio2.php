

<?php 
if(isset($_POST['borrar'])){

  $_POST = array();
}
var_dump($_POST);
include 'funciones.php';
if(isset($_POST['enviar'])){
  setcookie('fondo', $_POST['fondo'], time()+3600);
  setcookie('primer_plano', $_POST['primer_plano'], time()+3600);
  setcookie('fuente', $_POST['fuente'], time()+3600);
  setcookie('numero', $_POST['numero'], time()+3600);
}
?>
<style>
  form{
    background-color:<?php echo $_COOKIE['fondo'] ?>;
    color: <?php echo $_COOKIE['primer_plano'] ?>;
    font-family: <?php echo $_COOKIE['fuente'] ?>;
    font-size: <?php echo $_COOKIE['numero'] ?>;
  }
</style>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>Trabajando con cookies</h1>
    <p>Definicion del entorno:</p>
    <p>
    <label for="fondo">Color de fondo</label>
    <select name="fondo">
      <option value="green" <?php	if($_POST['fondo'] == "green"){echo "selected";}?>>green</option>
      <option value="blue" <?php	if($_POST['fondo'] == "blue"){echo "selected";}?>>blue</option>
      <option value="gray"<?php	if($_POST['fondo'] == "gray"){echo "selected";}?>>gray</option>
      <option value="yellow"<?php	if($_POST['fondo'] == "yellow"){echo "selected";}?>>yellow</option>
  </select>
  </p>
  <p>
  <label for="primer_plano">Color de primer plano:</label>
    <select name="primer_plano">
    <option value="green"<?php	if($_POST['primer_plano'] == "green"){echo "selected";}?>>green</option>
      <option value="blue"<?php	if($_POST['primer_plano'] == "blue"){echo "selected";}?>>blue</option>
      <option value="gray"<?php	if($_POST['primer_plano'] == "gray"){echo "selected";}?>>gray</option>
      <option value="yellow"<?php	if($_POST['primer_plano'] == "yellow"){echo "selected";}?>>yellow</option>
  </select>
  </p>
  <p>
  <label for="fuente">Fuente a utilizar:</label>
    <select name="fuente">
    <option value="Arial">Arial</option>
      <option value="Courier New"<?php	if($_POST['fuente'] == "Courier new"){echo "selected";}?>>Courier New</option>
      <option value="Comic Sans MS" <?php	if($_POST['fuente'] == "Comic Sans MS"){echo "selected";}?>>Comic Sans MS</option>
      <option value="Garamond" <?php	if($_POST['fuente'] == "Garamond"){echo "selected";}?>>Garamond</option>
      <option value="Tahoma"<?php	if($_POST['fuente'] == "Courier new"){echo "selected";}?>>Tahoma</option>
  </select>
  </p>
  <p>
  <label for="numero">Tamaño de la fuente:</label>
    <input type="number" name="numero" id="numero" min="1" value="<?php if(isset($_POST['numero'])){echo $_POST['numero'];}?>" required>
    <span>px</span>
  </p>
  <p>
    <input type="submit" name="enviar" value="enviar">
    <input type="submit" name="borrar" value="Borrar">
    </p>
</fieldset>
</form>




<?php

 


?>


