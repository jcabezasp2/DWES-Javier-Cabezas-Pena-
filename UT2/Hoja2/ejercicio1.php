<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';

    $cadena = "En un lugar de la Mancha";
    $arrayPalabras = explode(" ", $cadena);
    $cantidadPalabras = count(explode(" ", $cadena));
    $caracteresDiferentes =  implode("", caracteresDiferentes($cadena));
    echo "<h1>Contar las letras y palabras del siguiente texto:</h1>";
    echo "<p><strong>Texto: ". $cadena."</strong></p>";
    echo "<p>Numero de caracteres= ". strlen($cadena)."</p>";
    echo "<p>Letras y caracteres que aparecen en el texto= ".$caracteresDiferentes."</p>";
    echo "<p>Numero de palabras que aparecen en el texto= ".$cantidadPalabras."</p>";
    echo "<p>Veces que aparece cada letra o caracter</p>";
    echo caracterVeces($cadena);
    echo "<p><strong>Convertir en un array el texto</strong></p>";
    var_dump($arrayPalabras);
    echo "<p><strong>Convertir a texto separado por guiones</strong></p>";
    echo implode('-', $arrayPalabras);

    function caracteresDiferentes($cadena){

        $arrayResultado = str_split($cadena);
        $arrayResultado =  array_unique($arrayResultado);
         sort($arrayResultado);
        return $arrayResultado;
    }


    function caracterVeces($cadena){
        $arrayResultado = count_chars($cadena, 1);

        $resultado = "<table><th>cod ASCII</th><th>Caracter</th><th>Veces</th>";
        
        foreach($arrayResultado as $key => $value){
        $resultado .="<tr>";
        $resultado .="<td>".ord($value)."</td><td>".chr($key)."</td><td>".$value."</td>";
        $resultado .="</tr>";
    }
        $resultado .= "</table>";
       return $resultado;
    }

?>
