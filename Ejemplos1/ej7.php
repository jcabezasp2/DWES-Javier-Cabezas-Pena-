<HTML>
<HEAD>
<TITLE> Abecedario (10 primeras letras </TITLE>
</HEAD>

<BODY>
<center><h1>Ejercicio nº 7</h1><br>

<?php
    echo '<table border="1" width="100px">';
	$letra=64;
	for($i=1;$i<=10;$i++){
		echo '<tr><td>'.chr($letra+$i).'</td>';
		echo '<td>'.$i.'</td>';
		echo '</tr>';
	}
?>
</table>
</center>
</BODY>
</HTML>
