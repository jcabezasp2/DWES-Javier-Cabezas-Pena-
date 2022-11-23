<?php
include "conexion.php";
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
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <p>
        <label for="Usuario">Nombre</label>
        <input type="text" name="Usuario" id="Usuario" required>
        </p>
        <p>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        </p>
        <p>
        <label for="repetir">Repetir contraseña</label>
        <input type="password" name="repetir" id="repetir" required>
        </p>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>


<?php

    if(isset($_POST['enviar'])){
        
        $usuario = $_POST['Usuario'];
        $password = $_POST['password'];
        $repetido = $_POST['repetir'];

        if($password == $repetido){
            try{
                $password = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO clientes (idcliente, password) VALUES (:idcliente, :password)";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':idcliente'=>$usuario,':password'=>$password]);
            } catch (Exception $e) {
                 echo "Fallo: " . $e->getMessage();
             }
        }else{
            echo "Las contraseñas no coinciden";
        }
        // algoritmo = PASSWORD_BCRYPT

    }

?>
