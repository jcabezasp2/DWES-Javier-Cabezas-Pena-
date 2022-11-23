<?php


    function esbisiesto($anio)
	{
        $resultado;
        if($anio%100==0 && $anio%400!=0){
           $resultado="es bisieto";    
           
        }elseif($anio%4==0  ){
            $resultado="es bisiesto";
        }else{
            $resultado="no es bisiesto";
        }
        return $resultado;
	}

	echo esbisiesto(2020);
?>