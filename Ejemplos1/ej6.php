<!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8" />
  <title> Muestra las 10 primeras letras</title>
  <link href="estilo.css" rel="stylesheet" type="text/css" />
</head>



<BODY>
<h1>Abecedario de 10 letras</h1>
<?php
	for ($i=1;$i<=10;$i++){	
		echo chr(64+$i)."<br>";
  }
?>
</BODY>
</HTML>
