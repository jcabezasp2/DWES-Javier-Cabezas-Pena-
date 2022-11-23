<?php 

   

function mantenerCheckbox($nombre, $valor){
        $check = "";
        if(isset($_POST[$nombre])){
            $afic = $_POST[$nombre];
            if(in_array($valor, $afic) != false)
            $check = "checked";
        }

        return $check;
    }

function mantenerRadio($nombre, $valor){

$check = "";
if(isset($_POST[$nombre]) && $_POST[$nombre] == $valor){
    $check = "checked";
}
return $check;


}


?>