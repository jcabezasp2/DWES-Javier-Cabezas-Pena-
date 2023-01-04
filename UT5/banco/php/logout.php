<?php
   session_start ();
   date_default_timezone_set("Europe/Madrid");
   echo '<link rel="stylesheet" type="text/css" href="estilo.css" />';
   if (isset($_SESSION["idCliente"])){   
      session_destroy ();
      echo 'Cerrada la session';
   }else{
      echo 'Error';
   }
?>

