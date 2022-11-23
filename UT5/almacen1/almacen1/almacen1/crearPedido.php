<link rel="stylesheet" href="css/estilos.css">
<?php
include 'conexion.php';
session_start();
if(isset($_POST['elegidoElCliente'])){
    $_SESSION['clienteElegido'] = $_POST['cliente'];
}
if(isset($_POST['elegidoElProducto'])){
    $_SESSION['productoElegido'] = $_POST['producto'];
}
if(isset($_POST['elegidoLaCantidad'])){
    $_SESSION['cantidad'] = $_POST['cantidad'];
}



if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para ADMIN</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
 
}elseif($_SESSION['idCliente'] != '9999'){
    echo "<P>Acceso SOLO para ADMIN</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{
       
        try{
            $sql = "SELECT DISTINCT idcliente, nombre FROM clientes WHERE idcliente <> '9999'";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([]);
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
        }


?>
    <h1>Nuevo pedido</h1>
    <p>Hola usuario <?php echo $_SESSION['idCliente'] ?> , fecha de la conexion <?php echo $_SESSION['fechaConexion'] ?>, hora de la conexion <?php echo $_SESSION['horaConexion'] ?>  </p>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
        <label for="cliente">Cliente</label>
            <select name="cliente" id="cliente" required>
            <option selected disabled>Elegir</option>
<?php
        foreach($consulta as $fila){
            echo '<option value="'.$fila['idcliente'].'"'.(isset($_SESSION['clienteElegido'])? ($_SESSION['clienteElegido'] == $fila['idcliente'] ? " selected": "" ) : "").'>'.$fila['nombre'].'</option>';
        }
?>
        </select>


        <p>
            <button type="submit" name="elegidoElCliente">Enviar</button>
        </p>
    </form>
<?php
    if(isset($_POST['elegidoElCliente']) || isset($_SESSION['clienteElegido'])){

        
        try {
            $sql = "SELECT cod, nombre FROM producto WHERE stock > 0";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([]);
        
        } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
        }
?>
        <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">

        <label for="producto">Producto</label>
            <select name="producto" id="producto" required>
            <option selected disabled>Elegir</option>
<?php
        foreach($consulta as $fila){
            echo '<option value="'.$fila['cod'].'"'.(isset($_SESSION['productoElegido'])? ($_SESSION['productoElegido'] == $fila['cod'] ? " selected": "" ) : "").'>'.$fila['nombre'].'</option>';
        }
?>
        </select>
            <p>
                <button type="submit" name="elegidoElProducto">Enviar</button>
            </p>
        </form>
<?php
    }

    if(isset($_POST['elegidoElProducto'])){

        $cod = $_SESSION['productoElegido'];
        try {
            $sql = "SELECT stock, PVP, imagen FROM producto WHERE cod = :cod";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':cod'=>$cod]);
            $stock = $consulta->fetch(PDO::FETCH_OBJ);
            $_SESSION['precio'] = $stock->PVP;
            $_SESSION['imagen'] = $stock->imagen;
        } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
        }




?>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
        <p>
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" required min="1" max="<?php echo $stock->stock ?>">
         </p>

         <p>
                <button type="submit" name="elegidoLaCantidad">Enviar</button>
        </p>
    </form>

<?php

    }
    if(isset($_POST['elegidoLaCantidad'])){


        //var_dump($_POST);
        //var_dump($_SESSION);

        $cliente = $_SESSION['clienteElegido'];
        $producto = $_SESSION['productoElegido']; 
        $cantidad = $_SESSION['cantidad'];
        $fecha = date('Y-m-d');
        $precio = $_SESSION['precio'];
        $totalPedido = $_SESSION['precio'] * $_SESSION['cantidad'];
        $cod = $_SESSION['productoElegido'];
        $imagen =  $_SESSION['imagen'];
        $conexion->beginTransaction();

        try{
            $sql = "INSERT INTO pedidos (idcliente, fechapedido, totalpedido) VALUES (:idcliente, :fechapedido, :totalpedido)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idcliente'=>$cliente, ':fechapedido'=>$fecha, ':totalpedido'=>$totalPedido]);
            $idpedido = $conexion->lastInsertID();
            $sql = "INSERT INTO detallesdepedidos (idpedido, idproducto, cantidad, precio, imagen) VALUES (:idpedido, :idproducto, :cantidad, :precio, :imagen)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idpedido'=>$idpedido, ':idproducto'=>$producto, ':cantidad'=>$cantidad, ':precio'=>$precio, ':imagen'=>$imagen ]);
            $sql = "UPDATE producto SET stock = stock - :cantidad  WHERE cod = :cod";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':cantidad'=>$cantidad, ':cod'=>$producto]);
            $conexion->commit();

            if($consulta->rowCount() > 0){
                echo "Insertado con exito";
            }
        } catch (Exception $e) {
             $conexion->rollBack();
             echo "Fallo: " . $e->getMessage();
         }




    }

}
?>
