<?php

try{
    $opciones=array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8");
    $conexion = new PDO('mysql:host=localhost;dbname=neptuno','root', '', $opciones);
}catch (PDOException $e){
    echo "ERROR: ".$e->getMessage();
}
?>


