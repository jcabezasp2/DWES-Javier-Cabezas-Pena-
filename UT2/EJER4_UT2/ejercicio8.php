<?php
echo '<meta http-equiv="refresh" content="5" />';
$frutas = array("manzana", "fresa", "grosella", "guayaba", "kiwi", "pera", "naranja", "melocoton");
shuffle($frutas);
echo "<h2>Visualizando frutas</h2>";
$contador = 0;
foreach($frutas as $fruta){
    echo "<img src='frutas/".$fruta.".jpg'>";
    $GLOBALS['contador']++;

    echo($GLOBALS['contador'] % 4 != 0)? "" : "<br>";
}
?>