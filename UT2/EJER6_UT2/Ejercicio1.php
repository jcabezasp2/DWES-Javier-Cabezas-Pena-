<?php
echo '<link rel="stylesheet" href="estilo3.css">';
//var_dump($_POST);


if(isset($_POST['cantidad'])){
     
    echo "<p>El precio del pedido asciende a <strong>".calcular($_POST['cantidad'])."€</strong></p>";
    echo "<p><a href='Ejercicio1.php'>Volver al formulario</p></a>";
    echo $_SERVER[‘PHP_SELF’];
}else {
    
   echo '

   <style>

    h1{
        text-align: left !important;
        color: blue;
    }    

    #tableContainer{
    border: 3px solid #8686FF;
    width: fit-content;
    }

    table, td, th {
        border: 2px solid white;
        border-collapse: collapse;
    }

    th {
    background-color: blue;
    color: white;
    }

    td:nth-child(2){
    text-align: right;
    }
   </style>
   
         <body>
            
            <h1>LISTA DE PRECIOS</h1>
            <div id="tableContainer">
                <table>
                    <tr>
                        <th>Cantidad</th>
                        <th>Precio Unidad</th>
                    </tr>
                    <tr>
                        <td>menos de 10</td>
                        <td>2€</td>
                    </tr>
                    <tr>
                        <td>entre 10 y 30</td>
                        <td>1.5€</td>
                    </tr>
                    <tr>
                        <td>más de 30</td>
                        <td>1€</td>
                    </tr>
                </table>
            </div>
            <p>Seleccione la cantidad a pedir según nuestras tarifas</p>
            <form method="post" href="$_SERVER["PHP_SELF"]>
                <fieldset>
                    <legend>Datos pedido</legend>
                    <p>
                        <label for="cantidad">Número de cuadernos:</label>
                        <input type="number" name="cantidad" required min="1" placeholder="0" >
                    </p>
                        <input type="submit" name="enviar" value="enviar">
                </fieldset>
            
            </form>



        </body>';
}



function calcular($cantidad){

    $multiplicador;

    if($cantidad < 10){
        $multiplicador = 2; 
    }elseif($cantidad >= 10 && $cantidad <= 30){
        $multiplicador = 1.5; 
    }else{
        $multiplicador = 1; 
    }

return $cantidad * $multiplicador;
//return ($cantidad < 10)? $cantidad * 2 : ($cantidad >= 10 && $cantidad <= 30)? $cantidad * 1.5 : $cantidad * 1;
}
?>