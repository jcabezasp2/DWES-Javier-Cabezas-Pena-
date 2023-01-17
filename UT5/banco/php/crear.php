<?php
session_start();
include 'conexion.php';
date_default_timezone_set("Europe/Madrid");

if($_SESSION['idCliente'] == '9999A'){
    
    $accion = $_POST['accion'];

    if($accion == 'existeNumeroCuenta'){
        try {
            $numeroCuenta = $_POST['cuenta'];
            $sql = "SELECT COUNT(*) AS total FROM cuentas WHERE num_cta = :cuenta";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':cuenta'=> $numeroCuenta]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            if($resultado->total == 1){
                echo "2";
            }else{
                echo "0";
            }
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }
    }elseif($accion == 'existeId'){
        try {
            $idCliente = $_POST['id'];
            $sql = "SELECT COUNT(*) AS total FROM cliente WHERE id_cliente = :idCliente";

            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idCliente'=> $idCliente]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            if($resultado->total == 1){
                echo "0";
            }else{
                echo "2";
            }
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }
    }elseif($accion == 'insertar'){    
        $numeroCuenta = $_POST['numeroCuenta'];
        $idTitular = $_POST['idTitular'];
        $cantidad = $_POST['cantidad'];
        $fecha = date("Y/m/d");
        $tipo = "i";
        $conexion->beginTransaction();
        try {
            //Creacion de la cuenta
            $sql = "INSERT INTO cuentas (num_cta, fecha_apertura, id_cliente, saldo) VALUES (:numeroCuenta, :fecha, :idTitular, :cantidad )";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':numeroCuenta' => $numeroCuenta, ':idTitular' => $idTitular,':cantidad' => $cantidad, ':fecha' => $fecha]);
            $sql = "INSERT INTO movimcu (num_cta, fecha_mov, tipo_mov, importe) VALUES (:numeroCuenta, :fecha, :tipo, :importe)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':numeroCuenta'=> $numeroCuenta, ':fecha'=> $fecha, ':tipo' => $tipo, ':importe' => $cantidad]);     
            $conexion->commit();
        } catch (PDOException $e) {
            $conexion->rollBack();
            echo "ERROR:" . $e->getMessage();
        }

        if($consulta->rowCount() == 1){
            echo "0";
        }else{
            echo "1";
        }
    }else{
        echo 'error';
    }

}else{
    echo '1';
}
