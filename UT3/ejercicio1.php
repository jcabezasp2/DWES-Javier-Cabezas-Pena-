<html> <head> <title>Ejemplo fichero de texto</title> </head> <body> <h1>Fichero de texto</h1>
 <?php
    $fichero=fopen('prueba.txt','w');

    fwrite($fichero,'Este mensaje es una prueba'); 
    $fichero=fopen('prueba.txt','r'); 
    $texto=fread($fichero,1024);
    echo $texto;
    fclose($fichero); 
   
 ?> 
    </body> </html> 