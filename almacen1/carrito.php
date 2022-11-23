<link rel="stylesheet" href="css/estilos.css">
<?php
if(!isset($_COOKIE['idCliente'])){
    header("Location: login.php");
}
session_start();
include 'conexion.php';
if(!isset($_SESSION['idCliente'])){
    $_SESSION['idCliente'] = $_COOKIE['idCliente'];
}
try {
    $idPedido = $_COOKIE['idPedido'];
    $sql = "SELECT * FROM pedidos INNER JOIN detallesdepedidos ON detallesdepedidos.idpedido = pedidos.idpedido INNER JOIN producto ON producto.cod = detallesdepedidos.idproducto WHERE pedidos.idpedido = :idpedido";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':idpedido'=> $idPedido]);

} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}

    echo '
    <h1>Carrito del pedido '.$_COOKIE['idPedido'].'</h1>
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
        $idPedido = $_COOKIE['idPedido'];
        $sql = "SELECT * FROM pedidos  WHERE pedidos.idpedido = :idpedido";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idpedido'=> $idPedido]);
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }

    echo '<h3 class="total">TOTAL:'.$resultado->totalpedido.'€</h3>'; 
    echo '<a href="index.html">Volver a inicio</a>';


?>