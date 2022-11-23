<!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8" />
  <title> Suma menor que 80</title>
  <link href="estilo.css" rel="stylesheet" type="text/css" />
</head>


<BODY>
<h1>Suma no supera 80</h1>
<?php
	$i=1;
	$suma=1;
	while ($suma<=80){
		echo $i.'<br>';
		$i++;
		$suma=$suma+$i;  // o también  $suma+=$i;
	}
?>
</BODY>
</HTML>
