<?php

    $primerArray = array("Lagartija", "Araña", "Perro", "Gato", "Raton");
    $segundoArray = array(12, 34, 45, 52, 12);
    $tercerArray = array("Sauce", "Pino", "Naranjo", "Chopo", "Perro", 34);

    $nuevoArray = array_merge($primerArray, $segundoArray, $tercerArray);

    var_dump($nuevoArray);

?>