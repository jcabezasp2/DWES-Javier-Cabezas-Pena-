<?php

    $arrayFamilias = array(
        "Los simpson" => array ("padre" => "Homer",
                                "madre" => "Marge",
                               "hijos" => array( "Bart", "Lisa", "Maggie") 
    ),  "Los Griffin " => array ("padre" => "Peter",
                                "madre" => "Lois",
                                "hijos" => array( "Chris", "Meg", "Stewie"))
     );
    
     foreach($arrayFamilias as $apellido => $familia){
        
        echo "Familia: ".$apellido."\n";
            
            foreach($familia as $keymiembro => $miembro){
                if($keymiembro != "hijos"){
                    echo $keymiembro.": ".$miembro."\n";
                }
                else{
                    echo $keymiembro.": ";
                    foreach($arrayFamilias[$apellido]["hijos"] as $hijo){
                        echo $hijo." ";
                    }
                }
                
            }


        echo "\n\n";
     }
?>