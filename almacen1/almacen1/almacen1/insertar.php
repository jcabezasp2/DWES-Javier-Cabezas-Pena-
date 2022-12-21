<link rel="stylesheet" href="css/estilos.css">
<?php
include 'conexion.php';
session_start();

if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para ADMIN</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
 
}elseif($_SESSION['idCliente'] != '9999'){
echo "<P>Acceso SOLO para ADMIN</P>\n";
echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{
    
    if(!isset($_POST['enviar'])){
?>
<h1>Nuevo producto</h1>
<p> Hola usuario <?php echo $_SESSION['idCliente'] ?> , fecha de la conexion <?php echo $_SESSION['fechaConexion'] ?>, hora de la conexion <?php echo $_SESSION['horaConexion'] ?>  </p>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <p>
        <label for="codigo">Codigo</label>
        <input type="text" name="codigo" required>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">
    </p>
    <p>
        <label for="precio">PVP</label>
        <input type="number" min="0" step="0.01" name="precio" required>
    
        <label for="familia">Familia</label>
        <select name="familia" id="familia" required>

   
     <!-- SUGERENCIAS DE FAMILIA -->
<?php
     try {
        $sql = "SELECT DISTINCT familia from producto";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([]);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }
    
    foreach($consulta as $fila){
        echo '<option value="'.$fila['familia'].'">'.$fila['familia'].'</option>';
    }
?>
        </select>
    </p>
    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" required>
    <p>
        <button type="submit" name="enviar">Enviar</button>
    </p>


</form>
<?php
}elseif(isset($_POST['enviar'])){



$cod = $_POST['codigo'];
$nombre = (isset($_POST['nombre'])? $_POST['nombre'] : '');
$PVP = $_POST['precio'];
$familia = $_POST['familia'];
$imagen = $_FILES['imagen']['name'];
$stock = 10;
$original = $_FILES['imagen']['tmp_name'];
$directorio = "imagenes/";
$insertado = false;

try {
    $sql = "SELECT cod FROM producto WHERE cod = :cod";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':cod'=> $cod]);
} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}

    $existe = $consulta->rowCount();

    if($existe == 1){
        echo "El producto ya existe en la base de datos";
        echo '<a href="insertar.php">Volver al formulario</a>'; 
    }else{

    try {
        if($_FILES['imagen']['type'] == 'image/jpeg' || $_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/bmp' ){
            $sql = "INSERT INTO producto (cod, ".($nombre != ''? 'nombre, ' : '')." PVP, familia, imagen, stock) VALUES (:cod, ".($nombre != ''? ':nombre,' : '')." :PVP, :familia, :imagen, :stock)";
            $consulta = $conexion->prepare($sql);
            if(isset($_POST['nombre'])){
                $consulta->execute([':cod'=> $cod, ':nombre'=> $nombre, ':PVP' => $PVP, ':familia' => $familia, ':imagen' => $imagen, ':stock' => $stock]);
            }else{
                $consulta->execute([':cod'=> $cod, ':PVP' => $PVP, ':familia' => $familia, ':imagen' => $imagen, ':stock' => $stock]);
            }      
            move_uploaded_file($original, $directorio.$imagen);
            $insertado = $consulta->rowCount();
        }else{

            echo "Formato de imagen no admitido";
            echo '<a href="insertar.php">Volver al formulario</a>'; 

        }


    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }

    if($insertado == 1){
        try {
                $sql = "SELECT * FROM producto WHERE cod = :cod";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':cod'=> $cod]);
    
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        echo "<h1>Se han insertado ".$consulta->rowCount()." productos</h1><br>";
        ?>

        <table>
            <tr>
                <th>Cod</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>PVP</th>
                <th>Familia</th>
                <th>Imagen</th>
                <th>Stock</th>
            </tr>
            <tr>
                <td><?php echo $resultado->cod ?></td>
                <td><?php echo $resultado->nombre ?></td>
                <td><?php echo $resultado->descripcion ?></td>
                <td><?php echo $resultado->PVP ?></td>
                <td><?php echo $resultado->familia ?></td>
                <td><img src="imagenes/<?php echo $resultado->imagen ?>" alt="Imagen"></td>
                <td><?php echo $resultado->stock ?></td>
            </tr>
        </table>

<?php
            echo '<a href="index.html">Volver a inicio</a>'; 
    }
}
}
}

?>