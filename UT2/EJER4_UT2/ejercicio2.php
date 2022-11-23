<?php

$nombres = array("Roberto", "Juan", "Marta", "Mercedes", "Martin", "Jorge", "Miriam", "Nahuel", "Mirta");

$filtrado = filtrarArray($nombres);

foreach($filtrado as $item){

    echo $item;
    echo ($item == end($filtrado)) ?  "." : "; ";

}


function filtrarArray($parametro){

$resultado = array();

    foreach($parametro as $item){

        

        if(str_starts_with($item, 'M')){
            array_push($resultado, $item);
        }
    }

return $resultado;
}


?>