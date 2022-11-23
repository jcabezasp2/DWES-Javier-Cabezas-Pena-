<?php

    $miArray = array("md" => "Madrid",
     "ba" => "Barcelona",
      "lo" => "Londres",
      "ny" => "New York",
      "la" => "Los Angeles",
      "ch" => "Chicago");

    foreach($miArray as $key => $value){
        echo $key.": ".$value."\n";
    }
?>