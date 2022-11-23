<?php
// MODELO DE COOKIE
setcookie('num_accesos', $accesos, time()+3600);

// MODELO DE TRANSACCION

$conexion->beginTransaction();
        try{
            $sql = "SELECT idcliente, nombre FROM clientes WHERE email = :email AND password = :password";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':email'=> $email, ':password'=> $password]);
            $conexion->commit();
        } catch (Exception $e) {
             $conexion->rollBack();
             echo "Fallo: " . $e->getMessage();
         }


// TERNARIA DOBLE
(isset($_SESSION['idPedido'])? ($_SESSION['idPedido'] == $fila['idpedido'] ? " selected": "" ) : "")

?>


<?php
        // SACAR UN VALOR DE UNA CONSULTA
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
                $cantidadPrevia = $resultado->cantidad;
?>

<?php
    // MODELO DE SELECT
try{
            $sql = "SELECT DISTINCT idcliente, nombre FROM clientes WHERE idcliente <> '9999'";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([]);
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
        }


?>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
        <label for="cliente">Cliente</label>
            <select name="cliente" id="cliente" required>
            <option selected disabled>Elegir</option>
<?php
        foreach($consulta as $fila){
            echo '<option value="'.$fila['idcliente'].'"'.(isset($_SESSION['clienteElegido'])? ($_SESSION['clienteElegido'] == $fila['idcliente'] ? " selected": "" ) : "").'>'.$fila['nombre'].'</option>';
        }
?>
        </select>


        <p>
            <button type="submit" value="elegidoElCliente" name="elegidoElCliente">Enviar</button>
        </p>
    </form>
<?php

        //MODELO DE DOBLE ARRAY EN TABLA    

        foreach($consulta as $fila){

            echo '
            <tr>
            <td class="titulo">'.$fila['idpedido'].'</td>
            <td class="texto">'.$fila['idproducto'].'</td>
            <td class="categoria">'.$fila['nombreproducto'].'</td>
            <td class="fecha">'.$fila['cantidadporunidad'].'</td>
            <td class="cantidad"><input value="cantidad" type="number" name="cantidad['.$fila["idproducto"].']" id="cantidad" max="'.$fila['unidadesexistencia'].'" min="0"></td>
            <td><input type="checkbox"  name="ids[]" value='.$fila['idproducto'].'></td>
            </tr>
            ';
            }
?>
 <?php
            // RECORRER CONSULTA
            $stmt = $conexion -> query("SELECT DISTINCT familia FROM producto");
            ?>
                <h1>Visualizar productos</h1>
            <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
            
                <label for="familia">Seleccion de familia:</label>
                <select name="familia" id="familia" required>
                <option value="todas">Todas</option>
            
            <?php
            
               while($fila = $stmt->fetch(PDO::FETCH_OBJ)){
                echo '<option value='.$fila->familia.'>'.$fila->familia.'</option>';
               }
            
            ?>