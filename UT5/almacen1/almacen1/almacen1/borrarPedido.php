<link rel="stylesheet" href="css/estilos.css">
<?php
include 'conexion.php';
include 'funciones.php';
session_start();
if(!isset($_SESSION['idCliente']) || $_SESSION['idCliente'] != '9999'){
    echo "<P>Acceso SOLO para ADMIN</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
 
}else{
    try {
        $sql = "SELECT * FROM pedidos INNER JOIN clientes ON pedidos.idcliente = clientes.idcliente";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([]);
    
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }
?>
    <h1>Borrar un pedido</h1>
     <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <table>
            <tr>
                <th>idpedido</th>
                <th>idcliente</th>
                <th>Nombre</th>
                <th>fecha</th>
                <th>Total</th>
                <th>Check</th>
            </tr>

<?php
            foreach($consulta as $fila){

            echo  '<tr>
                <td>'.$fila['idpedido'].'</td>
                <td>'.$fila['idcliente'].'</td>
                <td>'.$fila['nombre'].'</td>
                <td>'.$fila['fechapedido'].'</td>
                <td>'.$fila['totalpedido'].'</td>
                <td><input type="checkbox"  name="ids[]" value="'.$fila['idpedido'].'"'.mantenerCheckbox('ids', $fila['idpedido']).'></td>
                    </tr>';
            }

?>
        </table>
        <p>
            <button type="submit" name="elegidoElPedido">Enviar</button>
        </p>
    </form>

<?php
    if(isset($_POST['elegidoElPedido'])){

        foreach($_POST['ids'] as $id){// OJO ES UN BUCLE

            $conexion->beginTransaction();
            try{

                $sql = "SELECT idproducto, cantidad FROM detallesdepedidos WHERE idpedido = :idpedido";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':idpedido'=>$id]);
                    foreach($consulta as $producto){
                        $sql = "UPDATE producto SET stock = stock + :stock WHERE cod = :cod";
                        $consulta = $conexion->prepare($sql);
                        $consulta->execute([':stock'=>$producto['cantidad'], ':cod'=> $producto['idproducto']]);
                    }

                $sql = "DELETE detallesdepedidos, pedidos FROM detallesdepedidos INNER JOIN pedidos ON pedidos.idpedido = detallesdepedidos.idpedido WHERE pedidos.idpedido = :idpedido";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':idpedido'=> $id]);

                $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "Fallo: " . $e->getMessage();
            }

        }
        if($consulta->rowCount() > 0){
            echo "Exito";
        }


    }
    echo '<p>[<a href="logout.php">Desconectar</a>]</p>';
}

?>

<p>[<a href="index.html">Ir al menu</a>]</p>