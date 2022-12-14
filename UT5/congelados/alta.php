<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alta de usuario</h1>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value = "<?php echo (isset($_POST['registrar'])? $_POST['nombre'] :"" ) ?>">
        </p>
        <p>
            <label for="usuario">Usuario: *</label>
            <input type="text" name="usuario" id="usuario"  value = "<?php echo (isset($_POST['registrar'])? $_POST['usuario'] :"" ) ?>" required>
        </p>
        <p>
            <label for="contrasena">Clave: *</label>
            <input type="password" name="contrasena" id="contrasena"  value = "<?php echo (isset($_POST['registrar'])? $_POST['contrasena'] :"" ) ?>" required>
        </p>
        <p>
            <label for="contrasenaBis">Repetir clave:*</label>
            <input type="password" name="contrasenaBis" id="contrasenaBis"  value = "<?php echo (isset($_POST['registrar'])? $_POST['contrasenaBis'] : "" ) ?>" required>
        </p>
        <p>
            <label for="profesion">Profesion:</label>
            <select name="profesion" id="profesion">
                <option value="informatico">Informatico</option>
                <option value="contable">Contable</option>
                <option value="administrador">Administrador</option>
                <option value="auxiliar">Auxiliar</option>
            </select>
        </p>
        <p>
            <button type="submit" value="registrar" name="registrar">Insertar usuario</button>
        </p>
        <p>
            NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente.
        </p>
    </form>
<p>
    <a href="login.php">Iniciar sesion</a>
</p>
</body>
</html>

<?php
if(isset($_POST['registrar'])){
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $contrasenaBis = $_POST['contrasenaBis'];
    $profesion = $_POST['profesion'];


    try{
        $sql = "SELECT usuario FROM usuarios WHERE usuario = :usuario";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':usuario' => $usuario]);
    } catch (Exception $e) {
         echo "Fallo: " . $e->getMessage();
    }

    $cuantosCoinciden = $consulta->rowCount();
    if($cuantosCoinciden == 1 ){
        echo "<h3>Error, ya existe el usuario</h3>";
    }else if( $contrasena != $contrasenaBis){
        echo "<h3>Error, Las contraseñas no coinciden</h3>";
    }else{
        $password = password_hash($contrasena, PASSWORD_BCRYPT);
        try{
            $sql = "INSERT INTO usuarios (usuario, clave, nombre, profesion) VALUES (:usuario, :clave, :nombre, :profesion)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':usuario'=>$usuario, ':clave'=>$password ,':nombre'=>$nombre, ':profesion'=>$profesion]);
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
         }
         echo "<h3>El usuario ". $usuario." se ha creado con exito</h3>";
    }

}


?>