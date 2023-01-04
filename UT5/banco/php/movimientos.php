<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

if($_SESSION['idCliente'] != '9999A'){

    $accion = $_POST['accion'];
    if($accion == 'cuentas'){

        try {
            $sql = "SELECT num_cta FROM cuentas WHERE id_cliente = :id_cliente";
            $consulta = $conexion->prepare($sql);
            $consulta->execute(['id_cliente'=> $_SESSION['idCliente']]);
            
            $total = $consulta->rowCount();
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }
        $resultado = '{"cuentas": [';
        $contador = 0;
        
        foreach($consulta as $fila){
            //$resultado = $fila->fetch(PDO::FETCH_ASSOC);
            //$resultado .= '"'.$contador.'":';
            $resultado .= json_encode($fila);
            $contador++;
            if($total != $contador){
                $resultado .= ',';
            }
           
        }

        $resultado .= ']}';
        echo json_encode($resultado);

    }elseif($accion == 'datosCuenta'){
        try {
            $cuenta = $_POST['cuenta'];
            $sql = "SELECT num_cta, nombre, saldo FROM cuentas INNER JOIN cliente ON cliente.id_cliente = cuentas.id_cliente WHERE cuentas.num_cta = :cuenta";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':cuenta'=> $cuenta]); 
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);   
            //echo json_encode($resultado);
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }

            $json = '{"datosCuenta": [';
            $contador = 0;
            $numcta = $resultado->num_cta;
            $json .= json_encode($resultado);
            $json .= ',';

            try {
                $sql = "SELECT * FROM movimcu WHERE num_cta = :num_cta";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':num_cta'=>$numcta]);
                $total = $consulta->rowCount();   
                //echo json_encode($resultado);
            } catch (PDOException $e) {
                echo "ERROR:" . $e->getMessage();
            }

            foreach($consulta as $fila){
                //$json = $fila->fetch(PDO::FETCH_ASSOC);
                //$json .= '"'.$contador.'":';
                $json .= json_encode($fila);
                $contador++;
                if($total != $contador){
                    $json .= ',';
                }
               
            }
    
            $json .= ']}';
            echo json_encode($json);




    }
}