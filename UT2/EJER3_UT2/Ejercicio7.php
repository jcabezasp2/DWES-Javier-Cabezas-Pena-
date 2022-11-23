<?php

    $miArray = array();

    for($i =1; $i <= 10; $i++){
        array_push($miArray, $i);
    }
    $totalPares = 0;
    $sumaPares = 0; 
    echo "Numeros impares: ";
    foreach($miArray as $key => $value){
        if($value%2==0){
            $GLOBALS['totalPares']++;
            $GLOBALS['sumaPares'] += $value;
        }else{
            echo $value." ";
        }
    }

    $mediaPares = $sumaPares/$totalPares;

    echo "\nMedia de los pares: ".$mediaPares;


?>