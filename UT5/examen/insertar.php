<link rel="stylesheet" href="css/estilos.css">
<?php
session_start();
include 'conexion.php';
include 'funciones.php';

if(!isset($_SESSION['idCliente']) || $_SESSION['idCliente'] != "BLONP"){
    echo "<P>Acceso SOLO para el usuario BLONP</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{
?>
<div id="datosConexion" >
<p>Usuario <?php echo $_SESSION['idCliente'] ?></p>
<p>hora de la conexion <?php echo $_SESSION['horaConexion'] ?></p>
<p>fecha de la conexion <?php echo $_SESSION['fechaConexion'] ?></p> 
</div>
<h1>Gestión de PEDIDOS (NEPTUNO)</h1>
<h3>Insertar producto </h3>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="producto">IdProducto: </label>
<input placeholder=" <?php echo (isset($_POST['enviarIdProducto'])? $_POST['producto'] : "")?>" type="number" name="producto" id="producto" required>
        <p>
            <button type="submit" value="enviarIdProducto" name="enviarIdProducto">Comprobar producto</button>
        </p>

</form>

<?php
if(isset($_POST['enviarIdProducto']) || isset($_POST['enviarDatos'])){
    $idproducto = $_POST['producto'];
    try{
        $sql = "SELECT idproducto FROM productos WHERE idproducto = :idproducto";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':idproducto'=>$idproducto]);
    } catch (Exception $e) {
         echo "Fallo: " . $e->getMessage();
    }

      $resultado = $consulta->fetch(PDO::FETCH_OBJ);
      if($idproducto == $resultado->idproducto){
        echo "<p>Producto YA EXISTE</p>";
      }else{
        ?>
       <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
       <p>
        <label for="producto">IdProducto: </label>
        <input readonly value="<?php echo $_POST['producto'] ?>" type="number" name="producto" id="producto" required>
        </p>
        <p>
        <label for="nombre">NombreProduc: </label>
        <input value=" <?php echo (isset($_POST['enviarDatos'])? $_POST['nombre'] : "")?>" type="text" name="nombre" id="nombre" required>
        </p>
        <?php

            try{
                $sql = "SELECT idproveedor, nombrecompañia FROM proveedores";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([]);
            } catch (Exception $e) {
                echo "Fallo: " . $e->getMessage();
            }


            ?>
            <p>
            <label for="proveedores">Proveedor:</label>
                <select name="proveedores" id="proveedores" required>
                <option selected disabled>Elegir</option>
            <?php
            foreach($consulta as $fila){
                echo '<option value="'.$fila['idproveedor'].'"'.(isset($_POST['enviarDatos'])? ($_POST['proveedores'] == $fila['idproveedor'] ? " selected": "" ) : "").'>'.$fila['nombrecompañia'].'</option>';
            }
            ?>
            </select>
            </p>
            <?php

            try{
                $sql = "SELECT idcategoria, nombrecategoria FROM categorias";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([]);
            } catch (Exception $e) {
                echo "Fallo: " . $e->getMessage();
            }


            ?>
            <p>
            <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" required>
                <option selected disabled>Elegir</option>
            <?php
            foreach($consulta as $fila){
                echo '<option value="'.$fila['idcategoria'].'"'.(isset($_POST['enviarDatos'])? ($_POST['categoria'] == $fila['idcategoria'] ? " selected": "" ) : "").'>'.$fila['nombrecategoria'].'</option>';
            }
            ?>
            </select>
            </p>
            <p>
                <label for="cantidadUnidad">CantidadporUnid: </label>
                <input value=" <?php echo (isset($_POST['enviarDatos'])? $_POST['cantidadUnidad'] : "")?>"  type="text" name="cantidadUnidad" id="cantidadUnidad" required>
            </p>
            <p>
                <label for="precio">PrecioUnidad: </label>
                <input value=" <?php echo (isset($_POST['enviarDatos'])? $_POST['precio'] : "")?>" min="1"  type="number" name="precio" id="precio" required>
            </p>
            <p>
                <label for="stock">Stock: </label>
                <input readonly value="10" type="number" name="stock" id="stock" required>
            </p>


            <p>
                <button type="submit" value="enviarDatos" name="enviarDatos">Insertar producto</button>
            </p>
        </form>
            <?php
      }
}
    if(isset($_POST['enviarDatos'])){
        $idproducto = $_POST['producto'];
        $nombre = $_POST['nombre'];
        $idproveedor = $_POST['proveedores'];
        $idcategoria = $_POST['categoria'];
        $cantidadPorUnidad = $_POST['cantidadUnidad'];
        $precio = $_POST['precio'];
        $unidades = $_POST['stock'];
        try{
            $sql = "INSERT INTO productos VALUES (:idproducto, :nombreproducto, :idproveedor, :idcategoria, :cantidadporunidad, :preciounidad, :unidadesexistencias)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idproducto'=>$idproducto, ':nombreproducto'=>$nombre, ':idproveedor'=>$idproveedor, ':idcategoria'=>$idcategoria, ':cantidadporunidad'=>$cantidadPorUnidad, ':preciounidad'=>$precio, ':unidadesexistencias'=>$unidades]);
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
        }
        if($consulta->rowCount() > 0){
            echo "Se ha insertado el producto";
         }
    }
}
?>
<p>[<a href="menu.php">Volver al menu</a>]</p>