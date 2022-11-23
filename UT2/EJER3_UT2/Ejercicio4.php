<?php

    $miArray = array("Nombre" =>"Pedro Torres",
     "Direccion" => "C/Mayor 37",
     "Telefono" => 123456789);

    foreach($miArray as $key => $value){
        echo $key.": ".$value."\n";
    }
?>