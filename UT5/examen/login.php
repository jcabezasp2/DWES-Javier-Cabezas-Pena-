<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/c43811ca98.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Login</h1>
<form action= "<?php $_SERVER['PHP_SELF']?>" method="post" id="login">
        <p>
            <label for="user">ID</label>
            <input type="text" name="user" id="user" required>
        </p>
        <p>
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass" required>
        </p>
        <p>
            <input type="submit" name="accion" value="Login">
        </p>
</form>
</body>
</html>

<?php
if(isset($_POST['accion'])){


    try {
            $email = $_POST['user'];
            $password = $_POST['pass'];
            $sql = "SELECT * FROM clientes WHERE idcliente = :email AND password = :password";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':email'=> $email, ':password'=> $password]);

    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }

    $cuantosCoinciden = $consulta->rowCount();
    if($cuantosCoinciden == 1 ){
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        $_SESSION['idCliente'] = $resultado->idcliente;
        $_SESSION['horaConexion'] = date('H:i:s');
        $_SESSION['fechaConexion'] = date('j-m-Y');

      header("Location: menu.php");

    }elseif($cuantosCoinciden == 0 ){
        ?> <script>alert("ERROR, Usuario o contraseña no validos")</script><?php ;
    }
}
?>