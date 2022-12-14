<?php
include 'conexion.php';
session_start ();
header("Content-type: application/json; charset=utf-8");
//header("Content-Type: text/html; charset=UTF-8");      
                
        $sql = "SELECT * FROM productos WHERE num_envase_prod = '2'";
        $resultado = $conexion->prepare($sql); 
        $resultado->execute();
        //devuelve un array con los datos de la consulta
        //PDO::FETCH_CLASS: Devuelve instancias de la clase especificada, 
        //haciendo corresponder las columnas de cada fila con las propiedades con nombre de la clase.
       
        $res=$resultado->fetchAll(PDO::FETCH_CLASS);
        //print_r($res);

        //Devuelve un string con la representación JSON de $res.  
        //echo json_encode($res);
              
        //echo "<h3 class='aviso'>Visualizando consulta como json formateado</h3>";
        //Devuelve un string con la representación JSON de $res FORMATEADA.
        //print_r(json_encode($res,JSON_PRETTY_PRINT));
      
        $json_pretty=json_encode($res, JSON_PRETTY_PRINT);
    
             
        //guarda los datos json en un fichero
        file_put_contents("myfile.json",$json_pretty);
        
        echo "<h3>Visualizando Fichero json decodificado</h3>";
        
        //recoge los datos del fichero en un array
        $data = file_get_contents("myfile.json");
        
        //Convierte un string codificado en JSON a una variable de PHP.
        // con true lo convierte a un array asociativo
        $products = json_decode($data, true);
       
        foreach ($products as $product) {
            print_r($product);
            
        }

        //con false a un objeto
        $productsobj = json_decode($data, false);
        //print_r($productsobj);
     
    
 
