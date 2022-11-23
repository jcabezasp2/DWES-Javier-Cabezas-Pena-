<?php 
//session_destroy();

if(!isset($_SESSION)){
    session_start();
    $_SESSION['numero'] = 0;
}

if($_POST['accion'] == "bajar"){
    $_SESSION['numero']--;
}

if($_POST['accion'] == "subir"){
    $_SESSION['numero']++;
}

if($_POST['accion'] == "borrar"){
    $_SESSION['numero'] = 0;
}


$numero = $_SESSION['numero'];
?>


<form action="<?php	$_SERVER['PHP_SELF']?>" method="post" style="width:80%;margin:auto">
<h1>SUBIR Y BAJAR NÚMERO</h1>
<h3>Haga clic en los botones para modificar el valor</h3>
<p>
    <button type="submit" name="accion" value="bajar" style="font-size:3em">&#x1F447;</button>
    <span style="font-size:3em"><?php echo $numero; ?></span>
    <button type="submit" name="accion" value="subir" style="font-size:3em">&#x1F446;</button>
</p>
<button  type="submit" name="accion" value="borrar" >Borrar</button>

</form>