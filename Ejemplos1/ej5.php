<!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8" />
  <title> Muestra 10 primeros naturales pares azul impares rojo</title>
  <link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<BODY>
<h1>Pares azul impares rojo</h1>
<?php
	for ($i=1;$i<=10;$i++){
		if ($i%2==0)
			echo "<font color='blue'>$i</font><br>";
		else
			echo "<font color='red'>$i</font><br>";
		
	}
?>
</BODY>
</HTML>
