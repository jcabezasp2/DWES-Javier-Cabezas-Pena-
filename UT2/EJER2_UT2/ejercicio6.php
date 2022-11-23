<?php

    function generateRow($string)
    {
        echo"<tr>";
        for($i=0;$i<strlen($string);$i++ ){
            echo "<td>".$string[$i]."<td>";
        }
        echo"</tr>";
    }

    function generateTable ($pri, $segun, $terc, $cuar)
	{
		echo "<table>";
       generateRow($pri);
       generateRow($segun);
       generateRow($terc);
       generateRow($cuar);
        echo"</table>";
		
	}

    $pri="abcde";
    $segun="fghijk";
    $terc="lmniop";
    $cuar="qrstuv";


	generateTable($pri,$segun,$terc,$cuar);
?>