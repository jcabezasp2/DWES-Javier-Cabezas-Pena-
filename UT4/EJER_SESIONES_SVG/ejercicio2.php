<?php 
//session_destroy();

session_start();
var_dump($_SESSION);
if(!isset($_SESSION)){

    $_SESSION['x'] = 0;
    $_SESSION['y'] = 0;

}

if($_POST['accion'] == "subir"){
    $_SESSION['y'] -= 20;
    if($_SESSION['y'] == -100){
        $_SESSION['y'] = 100;
    }
}

if($_POST['accion'] == "bajar"){
    $_SESSION['y'] += 20;
    if($_SESSION['y'] == 100){
        $_SESSION['y'] = -100;
    }
}

if($_POST['accion'] == "resetear"){
    $_SESSION['x'] = 0;
    $_SESSION['y'] = 0;
}

if($_POST['accion'] == "izquierda"){
    $_SESSION['x'] -= 20;
    if($_SESSION['x'] == -100){
        $_SESSION['x'] = 100;
    }
}

if($_POST['accion'] == "derecha"){
    $_SESSION['x'] += 20;
    if($_SESSION['x'] == 100){
        $_SESSION['x'] = -100;
    }
}

?>


<form action="<?php	$_SERVER['PHP_SELF']?>" method="post" style="width:80%;margin:auto">
<h1>SUBIR Y BAJAR NÚMERO</h1>
<h3>Haga clic en los botones para modificar el valor</h3>
<div style="float:left">
    <p>
    <button type="submit" name="accion" value="subir" style="font-size:3em">&#x1F446;</button>
    </p>
    <p>
    <button type="submit" name="accion" value="izquierda" style="font-size:3em">&#x1F448;</button>
    <button type="submit" name="accion" value="resetear" style="font-size:3em">BORRAR</button>
    <button type="submit" name="accion" value="derecha" style="font-size:3em">&#x1F449;</button>
    </p>
    <p>
    <button type="submit" name="accion" value="bajar" style="font-size:3em">&#x1F447;</button> 
    </p>
</div>
</form>
<div style="float:right">
<svg width="400" height="400" viewbox="-100 -100 200 200" style="border: 2px solid black">

<circle cx="<?php echo $_SESSION['x']; ?>"

cy="<?php echo $_SESSION['y']; ?>" r="4" fill="red">

</circle>

</svg>
</div>
