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

    }elseif($accion == 'insertarMovimiento'){
        $conexion->beginTransaction();
        try {
            $cantidad = $_POST['cantidad'];
            $tipo = $_POST['tipo'];
            $codigoCuenta = $_POST['codigoCuenta'];
            $fecha = date("Y/m/d");

            //Insercion del movimiento
            $sql = "INSERT INTO movimcu (importe, tipo_mov, num_cta, fecha_mov) VALUES (:importe, :tipo_mov, :num_cta, :fecha_mov)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':importe'=>$cantidad, ':tipo_mov'=>$tipo, ':num_cta'=>$codigoCuenta, ':fecha_mov'=>$fecha]);

        
            //Actualizacion del saldo
            if($tipo == 'I'){
                $sql = "UPDATE cuentas SET saldo = saldo + :cantidad WHERE num_cta = :num_cta";       
            }else{
                $sql = "UPDATE cuentas SET saldo = saldo - :cantidad WHERE num_cta = :num_cta";
            }
            $consulta = $conexion->prepare($sql); 
            $consulta->execute([':cantidad'=>$cantidad, ':num_cta'=>$codigoCuenta]);

            $conexion->commit(); 
        } catch (PDOException $e) {
            $conexion->rollBack();
            echo "ERROR:" . $e->getMessage();
        }

        if($consulta->rowCount() >= 1){
                $sql = "SELECT saldo FROM cuentas WHERE num_cta = :codigoCuenta";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([':codigoCuenta'=>$codigoCuenta]);
                $resultado = $consulta->fetch(PDO::FETCH_OBJ);
                echo $resultado->saldo;
        }else{
            echo "1";
        }
    }
}