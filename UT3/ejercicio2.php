<?php
 $fichero = fopen('contaminacionatmosferica.csv','r');
  echo "<table><th>Nombre</th><th>Apellido</th><th>Teléfono</th>";
   while (( $persona = fgetcsv( $fichero , 2048, "," ) ) !== false ) { 
    echo "<tr>";
    foreach($persona as $dato) { 
            echo "<td> ". $dato ."</td>";
     }  
    echo "</tr>";
         }
fclose($fichero);
echo "</table>"; ?> 