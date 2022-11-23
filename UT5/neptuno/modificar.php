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
<h3>Modificar pedidos de cliente: <?php echo $_SESSION['idCliente'] ?></h3>
<?php

if($existe){
try {
        $idcliente = $_SESSION['idCliente'];
        $sql = "SELECT idpedido FROM pedidos WHERE idcliente = :idcliente";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idcliente'=>$idcliente]);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }
?>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="pedido">Pedidos: </label>
        <select name="pedido" id="pedido" required>
<?php

    
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

     if(isset($_POST['enviarPedido']) || isset($_POST['enviardatos'])){

        try {
            $idpedido = $_SESSION['idpedido'];
            $sql = "SELECT *, (productos.unidadesexistencia + detallesdepedidos.cantidad) AS maximo FROM detallesdepedidos INNER JOIN productos ON productos.idproducto = detallesdepedidos.idproducto WHERE detallesdepedidos.idpedido = :idpedido";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idpedido'=>$idpedido]);
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }

?>
        <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">



        <table>
<tr>
    <th class="titulo">idpedido</th>
    <th class="texto">idproducto</th>
    <th class="categoria">nombreProducto</th>
    <th class="fecha">cantidadporunidad</th>
    <th class="imagen">cantidad</th>
    <th class= "check">selecciona</th>
</tr>

<?php

foreach($consulta as $fila){

echo '
<tr>
<td class="titulo">'.$fila['idpedido'].'</td>
<td class="texto">'.$fila['idproducto'].'</td>
<td class="categoria">'.$fila['nombreproducto'].'</td>
<td class="fecha">'.$fila['cantidadporunidad'].'</td>
<td class="cantidad"><input value='.(isset($_POST['enviardatos'])? $_POST['cantidad'][$fila["idproducto"]] : $fila['cantidad']).' type="number" name="cantidad['.$fila["idproducto"].']" id="cantidad" max="'.$fila['maximo'].'" min="0"></td>
<td><input type="checkbox"  name="ids[]" value="'.$fila['idproducto'].'"'.mantenerCheckbox('ids', $fila['idproducto']).'></td>
</tr>
';
}



?>

</table>

        <p>
            <button type="submit" name="enviardatos">Enviar pedido</button>
        </p>
        </form>
<?php
     }

     if(isset($_POST['enviardatos'])){
        
        $idpedido = $_SESSION['idpedido'];
        $modificados = 0;
        foreach($_POST['ids'] as $idproducto){
            $conexion->beginTransaction();
            try{
                // SACAR CANTIDAD ANTIGUA
                $sql = "SELECT cantidad, preciounidad FROM detallesdepedidos WHERE idpedido = :idpedido AND idproducto = :idproducto";
                $consulta = $conexion->prepare($sql);
                $consulta->execute(['idpedido'=>$idpedido, ':idproducto'=>$idproducto]);
                $resultado = $consulta->fetch(PDO::FETCH_OBJ);
                $cantidadPrevia = $resultado->cantidad;
                $precioUnidad = $resultado->preciounidad;
                $nuevaCantidad = $_POST['cantidad'][$idproducto];
                // La comprobacion de que la nueva cantidad no exceda el stock se realiza en el formulario
                if($nuevaCantidad > $cantidadPrevia){
                    $diferenciaCantidad = $nuevaCantidad - $cantidadPrevia;
                    $diferenciaDinero = $diferenciaCantidad * $precioUnidad;
                    $sql = "UPDATE pedidos INNER JOIN detallesdepedidos ON pedidos.idpedido = detallesdepedidos.idpedido
                    INNER JOIN productos ON productos.idproducto = detallesdepedidos.idproducto SET productos.unidadesexistencia = productos.unidadesexistencia - :diferencia,
                    pedidos.totalpedido = totalpedido + :diferenciaDinero, detallesdepedidos.cantidad = :cantidad WHERE detallesdepedidos.idproducto = :idproducto AND detallesdepedidos.idpedido = :idpedido";
                    $consulta = $conexion->prepare($sql);
                    $consulta->execute([':diferencia'=>$diferenciaCantidad, ':cantidad'=>$nuevaCantidad ,':diferenciaDinero'=>$diferenciaDinero, ':idproducto'=>$idproducto, ':idpedido'=>$idpedido]);
                }else{
                    $diferenciaCantidad = $cantidadPrevia - $nuevaCantidad;
                    $diferenciaDinero = $diferenciaCantidad * $precioUnidad;
                    $sql = "UPDATE pedidos INNER JOIN detallesdepedidos ON pedidos.idpedido = detallesdepedidos.idpedido
                    INNER JOIN productos ON productos.idproducto = detallesdepedidos.idproducto SET productos.unidadesexistencia = productos.unidadesexistencia + :diferencia,
                    pedidos.totalpedido = totalpedido - :diferenciaDinero, detallesdepedidos.cantidad = :cantidad WHERE detallesdepedidos.idproducto = :idproducto AND detallesdepedidos.idpedido = :idpedido";
                    $consulta = $conexion->prepare($sql);
                    $consulta->execute([':diferencia'=>$diferenciaCantidad, ':cantidad'=>$nuevaCantidad , ':diferenciaDinero'=>$diferenciaDinero, ':idproducto'=>$idproducto, ':idpedido'=>$idpedido]);
                }

                $conexion->commit();
                $modificados++;
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "Fallo: " . $e->getMessage();
            }
        }
        echo 'Se han modificado '.$modificados. ' productos.';
     }

     
    echo '<p>[<a href="logout.php">Desconectar</a>]</p>';
}
?>
<p>[<a href="menu.html">Ir al menu</a>]</p>
