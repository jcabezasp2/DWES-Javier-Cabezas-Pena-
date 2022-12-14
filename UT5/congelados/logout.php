<?php
   session_start ();
   date_default_timezone_set("Europe/Madrid");
   echo '<link rel="stylesheet" type="text/css" href="estilo.css" />';
   if (isset($_SESSION["idCliente"])){   
      session_destroy ();
      header("Location: login.php");
   }else{
      header("Location: login.php");
   }
?>

