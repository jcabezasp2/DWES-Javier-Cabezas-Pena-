<HTML>
<HEAD>
<TITLE> Tabla de multiplicar del 8 </TITLE>
<link href="estilo.css" rel="stylesheet" />
</HEAD>

<BODY>
<h1>Ejercicio nº 8</h1><br>
<table>
<?php
	
	for($i=1;$i<=10;$i++){
		echo '<tr><td>8x'.$i.'= </td>';
		echo '<td>'.(8*$i).'</td></tr>';
	}
?>
</BODY>
</HTML>
