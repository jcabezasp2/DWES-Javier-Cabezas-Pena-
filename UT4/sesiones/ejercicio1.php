

<?php 
//ini_set("session.cookie_lifetime", 6);


//session_start();
echo "id de la sesion ".session_id();
var_dump($_SESSION);
//session_destroy();
//$_SESSION = array ();
//var_dump($_SESSION);
setcookie(session_name(), "", time() -3600, "/");
if(isset($_POST['enviar'])){
  $_SESSION['usuario'] = $_POST['campousuario'];
  $_SESSION['clave'] = $_POST['campoclave'];
}else{

}
?>

<table>
    <form action="<?php    $_SERVER['PHP_SELF']?>" method="POST">
    <tr>
        <td>Nombre de usuario:</td>
        <td><input type="text" name="campousuario" required></td>
    </tr>
    <tr>
        <td>Clave:</td>
        <td><input type="password" name="campoclave" required></td>
    </tr>
    <tr>
        <td><input type="submit" name="enviar" value="confirmar"></td>
    </tr>
    </form>
    </table>




<?php

if(isset($_POST['enviar'])){
  
}
 


?>


