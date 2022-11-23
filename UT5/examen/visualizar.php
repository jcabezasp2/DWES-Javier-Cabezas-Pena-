<link rel="stylesheet" href="css/estilos.css">
<?php
include 'conexion.php';
include 'funciones.php';


try{
    $sql = "SELECT idproducto, nombreproducto FROM productos";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([]);
} catch (Exception $e) {
     echo "Fallo: " . $e->getMessage();
}


?>
<h1>Selecciona el producto</h1>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<label for="producto">Producto</label>
    <select name="producto" id="producto" required>
    <option selected disabled>Elegir</option>
<?php
foreach($consulta as $fila){
    echo '<option value="'.$fila['idproducto'].'"'.(isset($_POST['elegidoElProducto'])? ($_POST['producto'] == $fila['idproducto'] ? " selected": "" ) : "").'>'.$fila['nombreproducto'].'</option>';
}
?>
</select>


<p>
    <button type="submit" name="elegidoElProducto" value="elegidoElProducto" >Enviar</button>
</p>
</form>
<?php


    if(isset($_POST['elegidoElProducto'])){
        $idproducto = $_POST['producto'];
        try{
            $sql = "SELECT nombreproducto FROM productos  WHERE idproducto = :idproducto";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idproducto'=> $idproducto]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            $nombre = $resultado->nombreproducto;
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
         }
         echo "Visualizando pedidos para el producto: ".$nombre; 

        try{
 
            $sql = "SELECT * FROM productos INNER JOIN detallesdepedidos ON detallesdepedidos.idproducto = productos.idproducto INNER JOIN pedidos ON pedidos.idpedido = detallesdepedidos.idpedido WHERE productos.idproducto = :idproducto";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idproducto'=> $idproducto]);

        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
         }
         if($consulta->rowCount() == 0){
            echo "<p>El producto ".$nombre." NO esta en ningun pedido</p>";
         }else{
?>

         <table>

         <tr>
            <th>Nombreproducto</th>
            <th>Idpedido</th>
            <th>Idcliente</th>
            <th>cantidad por unidad</th>
            <th>precio unidad</th>
         </tr>

<?php
         foreach($consulta as $fila){

           echo' <tr>
            <td>'.$fila['nombreproducto'].'</td>
            <td>'.$fila['idpedido'].'</td>
            <td>'.$fila['idcliente'].'</td>
            <td>'.$fila['cantidad'].'</td>
            <td>'.$fila['preciounidad'].'</td>
            </tr>';

         }

?>

        </table>


        <?php
                 }
    }
?>
    <p>[<a href="menu.php">Volver al menu</a>]</p>

