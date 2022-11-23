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
<h3>INSERTAR UN NUEVO PEDIDO PARA USUARIO LOGUEADO</h3>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<p>
<label for="idpedido">Idpedido: </label>
<input type="number" name="idpedido" id="idpedido">
</p>
<p>
    <label for="idcliente">Idcliente: </label>
    <input readonly type="text" name="idcliente" id="idcliente" value="<?php echo $_SESSION['idCliente'] ?>">
</p>
<p>
    <label for="fecha">Fecha para todo: </label>
    <input type="date" name="fecha" id="fecha">

</p>

<?php
?>
    <button type="submit" value="enviar">Enviar</button>
</form>


<?php
    if(isset($_POST['enviar'])){
        try{
            $sql = "SELECT idpedido FROM clientes WHERE idpedido = :idpedido";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([]);
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
        }


        if($consulta->rowCount() > 0 ){
            echo "<h3>El pedido ya existe en la base de datos</h3>";
        }else{
            
        }
    }
}
