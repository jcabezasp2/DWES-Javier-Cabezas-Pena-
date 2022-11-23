<?php

	$pares = array();

    for($i = 2; $i <= 20; $i += 2){
        array_push($pares, $i);
    }

    foreach($pares as $par){
        echo $par."\n";
    }
?>