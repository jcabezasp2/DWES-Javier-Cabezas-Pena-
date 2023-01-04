<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

//echo "Nombre: ".$_POST["correo"]." // Apellido: ".$_POST["password"];

try {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT clave FROM cliente WHERE email = :email";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':email' => $email]);
    $resultado = $consulta->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}

$cuantosCoinciden = $consulta->rowCount();
if($cuantosCoinciden == 1 ){
    if(password_verify($_POST['password'], $resultado->clave)){      
            try {
                $sql = "SELECT id_cliente, nombre FROM cliente WHERE email = :email";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':email' => $email]);
                $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "ERROR:" . $e->getMessage();
            }
            $_SESSION['idCliente'] = $resultado->id_cliente;
            $_SESSION['horaConexion'] = date('H:i:s');
            $_SESSION['fechaConexion'] = date('j-m-Y');
            echo $resultado->id_cliente.':'.$resultado->nombre;
        }else{
             echo '2';
        }



}elseif($cuantosCoinciden == 0 ){
     echo "3" ;
}