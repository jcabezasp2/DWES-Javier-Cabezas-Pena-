<?php
echo "<table>";
for($i = 0; $i <5 ; $i++){
    echo "<tr>";
    for($x = 0; $x < 15; $x++){
        echo "<td>";

        if($i == 0 || $i == 4){
            echo  "1";
        }else {
            echo ($x == 0 || $x == 14)? "1": "0";
        }

        
        echo "</td>";
    }
echo "</tr>";
}




echo "</table>";

?>