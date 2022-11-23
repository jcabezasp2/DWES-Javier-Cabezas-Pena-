<?php

$deportes = array("futbol", "baloncesto", "natacion", "tenis");

for($i = 0; $i < count($deportes); $i++ ){
echo $deportes[$i]."\n";
}
echo "\nTotal valores: ".count($deportes)."\n";
echo "Primer elemento del array ";
for($i = 0; $i < count($deportes); $i++ ){
    if($i == 0){
        echo $i."\n";
    }else if($i == 1){
       echo "Valor de segundo item: ".$deportes[$i];
    }else if($i == count($deportes) - 1){
        echo "\nValor del ultimo item: ".$deportes[$i];
    }
    
    }
?>