<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

try {
    $sql = "SELECT * FROM productos";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([]);
    $resultado = $consulta->fetch(PDO::FETCH_OBJ);
    echo json_encode($resultado);
} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}







