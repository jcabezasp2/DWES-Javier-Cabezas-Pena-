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


    $sql = "SELECT * FROM proveedores WHERE idproveedor IN (SELECT DISTINCT idproveedor FROM productos)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([]);

?>
<div id="datosConexion" >
<p>Usuario <?php echo $_SESSION['idCliente'] ?></p>
<p>hora de la conexion <?php echo $_SESSION['horaConexion'] ?></p>
<p>fecha de la conexion <?php echo $_SESSION['fechaConexion'] ?></p> 
</div>
<h1>Gestión de PEDIDOS (NEPTUNO)</h1>
<h3>Aumentar el precio de los productos de un proveedor</h3>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="proveedor">Proveedor: </label>
        <select name="proveedor" id="proveedor" required>
<?php

    
    foreach($consulta as $fila){
        echo '<option value="'.$fila['idproveedor'].'"'.(isset($_POST['proveedor'])? ($_POST['proveedor'] == $fila['idproveedor'] ? " selected": "" ) : "").'>'.$fila['nombrecompañia'].'</option>';
    }
?>
        </select>

        <p>
            <label for="porcentaje">Porcentaje:</label>
            <input type="number" value=<?php echo (isset($_POST['enviarProveedor'])? $_POST['porcentaje'] :"") ?> id="porcentaje" name="porcentaje" min ="1" step="1">
        </p>

        <p>
            <button type="submit" name="enviarProveedor">Enviar</button>
        </p>

</form>

<p>[<a href="menu.html">Ir al menu</a>]</p>
<p>[<a href="logout.php">Desconectar</a>]</p>
<?php

    if(isset($_POST['enviarProveedor'])){

        $idproveedor = $_POST['proveedor'];
        $porcentaje = $_POST['porcentaje'] / 100;
        $conexion->beginTransaction();
        try{
            $sql = "UPDATE productos SET preciounidad = preciounidad + (preciounidad * :porcentaje) WHERE idproveedor = :idproveedor";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':porcentaje'=> $porcentaje, ':idproveedor'=>$idproveedor]);
            $conexion->commit();
            $cambiados = $consulta->rowCount();
        } catch (Exception $e) {
             $conexion->rollBack();
             echo "Fallo: " . $e->getMessage();
         }

         echo "Se han acualizado ".$cambiados;
    }


}
?>
