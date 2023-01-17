<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

//echo "id: ".$_POST["id"]." // nombre: ".$_POST["name"]." // email: ".$_POST["email"]." // clave ".$_POST["password"];

try {
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO cliente (id_cliente, nombre, email, clave) VALUES (:id, :nombre, :email, :clave)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':id' => $id, ':nombre' => $nombre,':email' => $email, ':clave' => $password]);
    
} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}

if($consulta->rowCount() == 1){
    echo "0";
}else{
    echo "1";
}