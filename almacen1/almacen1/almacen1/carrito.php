<link rel="stylesheet" href="css/estilos.css">
<?php
include 'conexion.php';
session_start();
if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para autorizados y distinto de ADMIN</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
 
}elseif($_SESSION['idCliente'] == '9999'){
echo "<P>Acceso SOLO para autorizados y distinto de ADMIN</P>\n";
echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{

try {
    $idPedido = $_SESSION['idPedido'];
    $sql = "SELECT * FROM pedidos INNER JOIN detallesdepedidos ON detallesdepedidos.idpedido = pedidos.idpedido INNER JOIN producto ON producto.cod = detallesdepedidos.idproducto WHERE pedidos.idpedido = :idpedido";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':idpedido'=> $idPedido]);

} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}

    echo '
    <h1>Carrito del pedido '.$_SESSION['idPedido'].'</h1>
    <table>
    <th>Cod</th>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Familia</th>
    <th>Imagen</th>
    <th>Cantidad</th>
    <th>PVP</th>
    <th>Subtotal</th>';
    foreach($consulta as $fila){
           
?>
            <tr>
            <td class="cod"><?php echo $fila['cod'] ?></td>
            <td class="nombre"><?php echo $fila['nombre'] ?></td>
            <td class="descripcion"><?php echo $fila['descripcion'] ?></td>
            <td class="familia"><?php echo $fila['familia'] ?></td>
            <td class="imagen"><img src="imagenes/<?php echo$fila['imagen']?>" alt="Imagen"></td>
            <td class="stock"><?php echo $fila['cantidad'] ?></td>
            <td class="PVP"><?php echo $fila['PVP'] ?>€</td>
            <td class="subtotal"><?php echo ($fila['PVP'] * $fila['cantidad']) ?>€</td>
            </tr>
<?php         
        }
    echo '</table>';

    try {
        $idPedido = $_SESSION['idPedido'];
        $sql = "SELECT * FROM pedidos  WHERE pedidos.idpedido = :idpedido";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idpedido'=> $idPedido]);
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }

    echo '<h3 class="total">TOTAL:'.$resultado->totalpedido.'€</h3>'; 
    echo '<a href="logout.php">Logout</a>';

}
?>