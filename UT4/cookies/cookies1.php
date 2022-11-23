<?php
$accesos=1;
if(isset($_COOKIE['num_accesos'])){
    $accesos=$_COOKIE['num_accesos'] + 1;
}
setcookie('num_accesos', $accesos, time()+3600);


if($accesos > 1)
    echo "Has accedido a esta pagina <B>$accesos</B> veces";
else
    echo "Es la primera vez que accedes a esta pagina";
echo "<a href='cookies1.php'>Actualizar</a> <a href='cookies1b.php'>Borrar</a>"

?>