<?php
session_start();
include 'conexion.php';

if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para usuarios registrados</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{
    echo "<p>Usuario ".$_SESSION['idCliente']."</p>";
    echo "<p>Hora de conexion ".$_SESSION['horaConexion']."</p>";
    if(!file_exists('./envase.txt')){
        echo "<h3>El fichero envase.txt no existe</h3>";
        echo "<P>[ <A HREF='envase.php' TARGET='_top'>Generar el fichero</A> ]</P>\n";
    }else{
        echo "<h3>Leyendo el fichero envase.txt</h3>";
        $fichero = fopen('envase.txt','r');
        while(!feof($fichero)){
            echo fread($fichero, 4092);
        }
        fclose($fichero);
       echo '<p><a href="envase.php">Crear un nuevo fichero envase.txt</a></p>';
    }
    ?>

    <p><a href="menu.html">Volver al menu</a></p>

    <?php
}