<?php
echo '<link rel="stylesheet" href="estilo3.css">';
//var_dump($_POST);

$numeradas = $_GET['celdas'];
$columnas = $_GET['numeradas'];








echo "<body>";
echo "<h1>TABLA NUMERADA (RESULTADO)</h1>";
if(isset($_GET['celdas']) && isset($_GET['celdas'])){
    echo "<p>".$resultado."</p>";
}else {
    echo "<p>ERROR, formulario no enviado</p>";
}

echo "<a href='Ejercicio4.html'><p>Volver al formulario</p></a>";


echo "</body>";
?>