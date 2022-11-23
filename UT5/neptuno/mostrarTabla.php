<?php
include 'conexion.php';

        try{
            $idproveedor = 2; // TODO cambiar
            $sql = "SELECT * FROM productos INNER JOIN proveedores ON proveedores.idproveedor = productos.idproveedor INNER JOIN categorias ON productos.idcategoria = categorias.idcategoria  WHERE productos.idproveedor = :idproveedor";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':idproveedor'=> $idproveedor]);

        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
         }
?>

         <table>

         <tr>
            <th>idProducto</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>cantidad por unidad</th>
            <th>precio unidad</th>
            <th>existencias</th>
         </tr>

<?php
         foreach($consulta as $fila){

           echo' <tr>
            <th>'.$fila['idproducto'].'</th>
            <th>'.$fila['nombreproducto'].'</th>
            <th>'.$fila['nombrecategoria'].'</th>
            <th>'.$fila['cantidadporunidad'].'</th>
            <th>'.$fila['preciounidad'].'</th>
            <th>'.$fila['unidadesexistencias'].'</th>
            </tr>';

         }

?>

        </table>