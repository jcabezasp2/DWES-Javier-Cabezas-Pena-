<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

<<<<<<< HEAD
/* $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode("/", $uri);

echo $uri[5]; */



$datos = $_POST;
//$datos = $_POST;
var_dump($datos);
//echo $datos;

//echo gettype( json_decode( $_POST, true));
//var_dump(json_encode($_POST));

//echo $_POST['email'];
//echo '{ "name": "John", "age": 22 }';
//echo json_encode( $_POST);
//echo "<script>console.log('Console: " . $_POST . "' );</script>";
//echo 'AAAA';
//echo json_encode($_POST);
/* try {
=======
//echo "Nombre: ".$_POST["correo"]." // Apellido: ".$_POST["password"];

try {
>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
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
<<<<<<< HEAD
     echo "ERROR, Usuario no registrado" ;
} */
=======
     echo "3" ;
}
>>>>>>> d54de53ae14fcb4e65de0bc98e990d4b45fc3692
