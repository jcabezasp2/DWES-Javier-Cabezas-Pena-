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

function hacerTabla($valor){
    $arrayResultado = count_chars($valor, 1);
    arsort($arrayResultado);
    $resultado = '<table>';

    foreach($arrayResultado as $key => $value){
        $resultado .="<tr>";
        $resultado .="<td>".chr($key)."</td><td>".$value."</td>";
        $resultado .="</tr>";
    }


    $resultado .= '</table>';
    return $resultado;
}



function comprobar(){

    echo "FUNCIONA";
}

?>