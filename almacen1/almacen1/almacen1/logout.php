<?php
   session_start ();
   date_default_timezone_set("Europe/Madrid");
   echo '<link rel="stylesheet" type="text/css" href="estilo.css" />';
   if (isset($_SESSION["idCliente"])){
     
      echo "Hasta pronto:[" . $_SESSION['idCliente']."]<br>";
      echo "Hora de conexion: " . $_SESSION['horaConexion']."<br>";
      echo "Hora desconexion:".date('H:i:s');
      session_destroy ();
   }else{
      echo "<br><br>";
      echo "<p align='center'>No existe una conexión activa</p>";
      echo "<p align='center'>[ <a href='login.php'>Conectar</a> ]</p>";
   }
   echo "<p align='center'>[ <a href='index.html'>VOLVER AL MENÚ</a> ]</p>";
?>

