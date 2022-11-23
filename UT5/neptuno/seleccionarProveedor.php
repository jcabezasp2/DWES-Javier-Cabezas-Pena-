<link rel="stylesheet" href="css/estilos.css">
<?php
session_start();
include 'conexion.php';
include 'funciones.php';


if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para usuarios logueados</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{


if(isset($_POST['elegidoElProveedor'])){
    $_SESSION['proveedorElegido'] = $_POST['proveedor'];
}

try{
    $sql = "SELECT idproveedor, nombrecompañia FROM proveedores";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([]);
} catch (Exception $e) {
     echo "Fallo: " . $e->getMessage();
}


?>
<h1>Seleccionar proveedor</h1>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="proveedor">Proveedor</label>
    <select name="proveedor" id="proveedor" required>
    <option selected disabled>Elegir</option>
<?php
foreach($consulta as $fila){
    echo '<option value="'.$fila['idproveedor'].'"'.mantenerSelect('proveedorElegido', $fila['idproveedor']).'>'.$fila['nombrecompañia'].'</option>';
}
?>
</select>


<p>
    <button type="submit" name="elegidoElProveedor" value="elegidoElProveedor" >Enviar</button>
</p>
</form>
<?php

}

