<?php

    $estadios_futbol = array('Barcelona'=>'Camp Nou', 'Real Madrid'=>'Santiago Bernabeu','Valencia'=>'Mestalla','Real Sociedad'=>'Anoeta');

    crearTabla($estadios_futbol, false);
    unset($estadios_futbol['Real Madrid']);
    echo "<br>";
    crearTabla($estadios_futbol, true);

    function crearTabla($parametro, $numerada){
        echo "<table>";
                $contador = 1;
            foreach($parametro as $key => $value){
                echo "<tr>";
                if($numerada){
                    echo "<td>".$contador."</td>";
                    $contador++;
                }
                    echo "<td>".$key."</td>";
                
                
                echo "<td>".$value."</td>";
                echo "</tr>";
            }

        echo "</table>";

    }



?>