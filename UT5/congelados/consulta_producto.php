<script src="https://kit.fontawesome.com/c43811ca98.js" crossorigin="anonymous"></script>
<?php
include 'conexion.php';

?>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
    <label for="categoria">Categoria: </label>
    <select name="categoria" id="categoria" required>
<?php

    $sql = "SELECT * FROM categorias";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([]);
    foreach($consulta as $fila){
        echo '<option value="'.$fila['numero_cat'].'"'.(isset($_POST['seleccionar'])? ($_POST['categoria'] == $fila['numero_cat'] ? " selected": "" ) : "").'>'.$fila['etiqueta_cat'].'</option>';
    }
?>
        </select>

        <p>
            <button type="submit" name="seleccionar">Seleccionar envase</button>
        </p>

    </form>
    <p><a href="menu.html">Volver al menu</a></p>
<?php
if(isset($_POST['seleccionar'])){
    $categoria = $_POST['categoria'];
    try{
        $sql = "SELECT * FROM productos INNER JOIN categorias ON productos.num_cat_prod = categorias.numero_cat INNER JOIN envases ON productos.num_envase_prod = envases.numero_env WHERE num_envase_prod = :categoria";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':categoria'=>$categoria]);
    } catch (Exception $e) {
         echo "Fallo: " . $e->getMessage();
    }
?>
    <table>
        <tr>
            <th>Numero_prod</th>
            <th>Etiqueta_prod</th>
            <th>Categoria</th>
            <th>Envase</th>
            <th>Precio</th>
            <th>Observaciones</th>
            <th>Fotografia</th>
        </tr>


<?php
    foreach($consulta as $fila){
     echo '<tr>
            <td>'.$fila['numero_prod'].'</td>
            <td>'.$fila['etiqueta_prod'].'</td>
            <td>'.$fila['etiqueta_cat'].'</td>
            <td>'.$fila['etiqueta_env'].'</td>
            <td>'.$fila['precio_prod'].'</td>
            <td>'.$fila['observaciones_prod'].'</td>
            <td>'.($fila['foto_prod'] == ''? '':   '<a target="_blank" href=./img/'.$fila['foto_prod'].'><i class="fa-solid fa-image"></i></a>').'</td>
        </tr>';
    }
?>
    </table>
<?php
}

