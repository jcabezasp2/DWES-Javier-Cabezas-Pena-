<?php

function validar($parametro){

    $resultado;

    if(strstr($parametro, "@") && strstr($parametro, ".")){
        $resultado = "Es valido";
    }else{
       $resultado = "No es valido";
    }

    return $resultado;
}




echo validar("j.vae@s");

?>