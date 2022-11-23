<?php

$coleccion = range(15, 35);	
shuffle($coleccion);
$primero = true;
foreach($coleccion as $elemento){
    if (!$GLOBALS['primero']){
        echo "--";
    }else{
        $GLOBALS['primero'] = false;
    }
    echo $elemento;
}


?>