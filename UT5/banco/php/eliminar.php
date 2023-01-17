<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

if($_SESSION['idCliente'] == '9999A'){
   
    $accion = $_POST['accion'];
    if($accion == 'cuentas'){
        try {
            $sql = "SELECT cuentas.num_cta, nombre FROM cuentas INNER JOIN cliente ON cliente.id_cliente = cuentas.id_cliente WHERE cuentas.id_cliente <> :idAdmin";
            $consulta = $conexion->prepare($sql);
            $consulta->execute(['idAdmin'=> '9999A']);
           
            $total = $consulta->rowCount();
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }
        $resultado = '{"cuentas": [';
        $contador = 0;
        
        foreach($consulta as $fila){
            $resultado .= json_encode($fila);
            $contador++;
            if($total != $contador){
                $resultado .= ',';
            }
           
        }

        $resultado .= ']}';
        echo json_encode($resultado);
    }elseif($accion == 'borrar'){
        $cuenta = $_POST['cuenta'];
        $conexion->beginTransaction();
        try {
            //Borrar movimientos
            $sql = "DELETE FROM movimcu WHERE num_cta = :num_cta";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':num_cta'=> $cuenta]);           
            // Borrar cuenta
            $sql = "DELETE FROM cuentas WHERE num_cta = :num_cta";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':num_cta'=> $cuenta]);   

            $conexion->commit();
            $total = $consulta->rowCount();
        } catch (PDOException $e) {
            $conexion->rollBack();
            echo "ERROR:" . $e->getMessage();
        }

        if($consulta->rowCount() >= 1){
            echo "0";
        }else{
            echo "1";
        }

    }
}