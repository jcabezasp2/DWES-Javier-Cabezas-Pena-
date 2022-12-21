<link rel="stylesheet" href="css/estilos.css">
<?php
session_start();
include 'conexion.php';

if(!isset($_SESSION['idCliente'])){
        echo "<P>Acceso SOLO para autorizados y distinto de ADMIN</P>\n";
        echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
     
}elseif($_SESSION['idCliente'] == '9999'){
    echo "<P>Acceso SOLO para autorizados y distinto de ADMIN</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{


?>
    <h1>Añadir producto a pedido</h1>
    <p> Hola usuario <?php echo $_SESSION['idCliente'] ?> , fecha de la conexion <?php echo $_SESSION['fechaConexion'] ?>, hora de la conexion <?php echo $_SESSION['horaConexion'] ?>  </p>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">

<?php

try {
    $idCliente = $_SESSION['idCliente'];
    $sql = "SELECT idpedido FROM pedidos WHERE idcliente = :idcliente";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':idcliente'=> $idCliente]);
    $cuantosCoinciden = $consulta->rowCount();

} catch (PDOException $e) {
echo "ERROR:" . $e->getMessage();
}

if($cuantosCoinciden == 0){
    try {
        $fechaPedido = date('Y-m-d');
        $totalPedido = 0;
        $sql = "INSERT INTO pedidos (idcliente, fechapedido, totalpedido) VALUES (:idcliente, :fechapedido, :totalpedido)";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idcliente'=> $idCliente, ':fechapedido'=> $fechaPedido, ':totalpedido'=> $totalPedido]);
        header("Location: pedido.php");
    } catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
    }
}

if(isset($_POST['pedido'])){
    $_SESSION['idPedido'] = $_POST['pedido'];
}

?>

<label for="pedido">Seleccion de Pedido:</label>
    <select name="pedido" id="pedido" required>
    <option selected disabled>Elegir</option>
<?php
foreach($consulta as $fila){
 echo '<option value='.$fila['idpedido'].(isset($_SESSION['idPedido'])? ($_SESSION['idPedido'] == $fila['idpedido'] ? " selected": "" ) : "").'>'.$fila['idpedido'].'</option>';
}
?>

</select>

<button type="submit" name="idSeleccionado">Enviar</button>
</form>
<?php

//BUSCAR NOMBRES
if(isset($_POST['idSeleccionado']) || isset($_POST['productoElegido'])){

    if(isset($_POST['pedido'])){
        $_SESSION['idPedido'] = $_POST['pedido'];
    }

    try {
        $idPedido = $_SESSION['idPedido'];
        $sql = "SELECT nombre, cod FROM producto WHERE cod NOT IN  (SELECT idproducto FROM detallesdepedidos WHERE idpedido = :cod) AND stock > 0";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':cod'=> $idPedido]);
    
    } catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
    }

    if(isset($_POST['producto'])){
        $_SESSION['producto'] = $_POST['producto'];
    }
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="producto">Seleccion de Producto:</label>
<select name="producto" id="producto" required onchange="document.getElementById('oculto').click()">
    <option selected disabled>Elegir</option>
<?php

foreach($consulta as $fila){
 echo '<option value='.$fila['cod'].(isset($_SESSION['producto'])? ($_SESSION['producto'] == $fila['cod'] ? " selected": "" ) : "").'>'.$fila['nombre'].'</option>';
}
?>

</select>
<button type="submit" id="oculto" name="productoElegido">Enviar</button>
</form>
<?php
}

if(isset($_POST['productoElegido'])){
    if(isset($_POST['producto'])){
        $_SESSION['producto'] = $_POST['producto'];
    }

try {
    $producto = $_SESSION['producto'];
    $sql = "SELECT * FROM producto WHERE cod = :cod";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':cod'=> $producto]);
} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}

$resultado = $consulta->fetch(PDO::FETCH_OBJ);
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post" id="anadirPedido">
    <div class="fila">
        <div>
            <img src="imagenes/<?php echo$resultado->imagen?>" alt="">
            <input type="hidden" name="imagen" value="<?php echo$resultado->imagen?>">
        </div>
        <div>
            <label for="descripcion"></label>
            <textarea readonly name="descripcion" id="" cols="30" rows="10"><?php echo $resultado->descripcion?></textarea>
        </div>
    </div>
    <div class="fila">
        <div>
            <label for="code">Codigo</label>
            <input readonly type="text" name="code" value="<?php echo	$resultado->cod?>" placeholder="<?php echo	$resultado->cod?>">
        </div>
        <div>
            <label for="familia">Familia</label>
            <input readonly type="text" name="familia" value="<?php echo $resultado->familia?>" placeholder="<?php echo $resultado->familia?>">
        </div>
    </div>

    <div class="fila">
        <div>
            <label for="PVP">Precio unitario</label>
            <input readonly type="text" name="PVP" value="<?php echo $resultado->PVP?>" placeholder="<?php echo $resultado->PVP?>">
        </div>
        <div>
            <label for="cantidad">Cantidad</label>
            <input  type="number" name="cantidad" min="1" max="<?php echo $resultado->stock?>" required>
        </div>
    </div>

        <div>
            <button type="submit" name="pedir">Añadir</button>
        </div>
</form>
<?php
}

if(isset($_POST['pedir'])){

    try {
        $idPedido = $_SESSION['idPedido'];
        $idProducto = $_POST['code']; 
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['cantidad'] * $_POST['PVP'];
        $imagen = $_POST['imagen'];
        $sql = "INSERT INTO detallesdepedidos (idpedido, idproducto, cantidad, precio, imagen) VALUES (:idpedido, :idproducto, :cantidad, :precio, :imagen); UPDATE pedidos SET totalpedido = totalpedido + :precio WHERE idpedido = :idpedido; UPDATE producto SET stock = stock - :cantidad WHERE cod = :idproducto";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idpedido'=> $idPedido, ':idproducto'=> $idProducto, ':cantidad'=> $cantidad, ':precio'=> $precio , ':imagen'=> $imagen]);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }
    //setcookie('idPedido', $_SESSION['idPedido'], time()+3600);
    header("Location: carrito.php");
}
}
?>