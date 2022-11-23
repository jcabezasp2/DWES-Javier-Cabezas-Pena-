<link rel="stylesheet" href="css/estilos.css">
<?php
session_start();
include 'conexion.php';
include 'funciones.php';

if(isset($_POST['enviarPedido'])){
    $_SESSION['idpedido'] = $_POST['pedido'];
}


if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para usuarios logueados</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{

    $sql = "SELECT idpedido FROM pedidos WHERE idcliente = :idcliente";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':idcliente'=>$_SESSION['idCliente']]);
    $existe = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div id="datosConexion" >
<p>Usuario <?php echo $_SESSION['idCliente'] ?></p>
<p>hora de la conexion <?php echo $_SESSION['horaConexion'] ?></p>
<p>fecha de la conexion <?php echo $_SESSION['fechaConexion'] ?></p> 
</div>
<h1>Gestión de PEDIDOS (NEPTUNO)</h1>
<h3>Eliminar pedidos de cliente: <?php echo $_SESSION['idCliente'] ?></h3>
<?php if($existe){?>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="pedido">Pedidos: </label>
        <select name="pedido" id="pedido" required>
<?php
     try {
        $idcliente = $_SESSION['idCliente'];
        $sql = "SELECT idpedido FROM pedidos WHERE idcliente = :idcliente";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idcliente'=>$idcliente]);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }
    
    foreach($consulta as $fila){
        echo '<option value="'.$fila['idpedido'].'"'.(isset($_SESSION['idpedido'])? ($_SESSION['idpedido'] == $fila['idpedido'] ? " selected": "" ) : "").'>'.$fila['idpedido'].'</option>';
    }
?>
        </select>

        <p>
            <button type="submit" name="enviarPedido">Enviar pedido</button>
        </p>

</form>

<?php
}else{
    echo "<h2>No existe ningun pedido para el cliente logueado</h2>";
}

if(isset($_POST['enviarPedido'])){
    
    $idPedido = $_POST['pedido'];
    $idcliente = $_SESSION['idCliente'];
    $conexion->beginTransaction();
    try{
        //  actualiza el numero de unidades de productos   
        $sql = "SELECT idproducto, cantidad FROM detallesdepedidos WHERE idpedido = :idpedido";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idpedido'=>$idPedido]);
                    
        foreach($consulta as $fila){
            $producto = $fila['idproducto'];
            $cantidad = $fila['cantidad'];
                $sql = "UPDATE productos SET unidadesexistencia = unidadesexistencia + :cantidad WHERE idproducto = :idproducto";
                $consulta = $conexion->prepare($sql);

               $consulta->execute([':cantidad'=> $cantidad, ':idproducto'=> $producto]);
        }

        // Borra  detallesdepedido y pedido
        $sql = "DELETE detallesdepedidos, pedidos FROM detallesdepedidos INNER JOIN pedidos ON pedidos.idpedido = detallesdepedidos.idpedido WHERE pedidos.idpedido = :idpedido";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idpedido'=> $idPedido]);

        $conexion->commit();
    } catch (Exception $e) {
         $conexion->rollBack();
         echo "Fallo: " . $e->getMessage();
     }
     if($consulta->rowCount() > 0){
        echo "Se ha borrado el pedido";
     }
     
}

echo '<p>[<a href="logout.php">Desconectar</a>]</p>';
}

?>

<p>[<a href="menu.html">Ir al menu</a>]</p>