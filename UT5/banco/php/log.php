<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

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
    if(password_verify($_POST['pass'], $resultado->clave)){      
            $_SESSION['idCliente'] = $_POST['email'];
            $_SESSION['horaConexion'] = date('H:i:s');
            $_SESSION['fechaConexion'] = date('j-m-Y');

        }else{
             echo "ERROR, Contraseña no valida";
        }



}elseif($cuantosCoinciden == 0 ){
     echo "ERROR, Usuario no registrado" ;
} */