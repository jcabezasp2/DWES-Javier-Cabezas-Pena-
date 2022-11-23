<?php

	
    $fechas = array(
        1 => array(
            'mes' => 12,
            'dia' => 30,
            'anio' => 2022
        ),
        2 => array(
            'mes' => 15,
            'dia' => 30,
            'anio' => 2020
        ),
        3 => array(
            'mes' => 12,
            'dia' => 30,
            'anio' => -100
        ),
        4 => array(
            'mes' => 2,
            'dia' => 29,
            'anio' => 2042
        ),
        4 => array(
            'mes' => 2,
            'dia' => 29,
            'anio' => 2020
        ),


    );

    foreach($fechas as $fecha){
       $correcta = checkdate($fecha['mes'], $fecha['dia'], $fecha['anio']);
       echo "La fecha ".$fecha['dia']."/".$fecha['mes']."/".$fecha['anio']." es ";
        if($correcta){
            echo "correcta\n";
        }else{
            echo "incorrecta\n";
        }
    }
?>