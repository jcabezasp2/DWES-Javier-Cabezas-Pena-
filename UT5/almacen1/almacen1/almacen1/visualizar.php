<script src="https://kit.fontawesome.com/c43811ca98.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/estilos.css">
<?php
include 'conexion.php';
if(!isset($_POST['visualizar'])){
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
    

</select>

    <input type="submit" name="visualizar" value="Visualizar">

</form>

<?php
}else{
try {
    if($_POST['familia'] == 'todas'){
        $sql = "SELECT * FROM producto";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([]);
    }else{
        $familia = $_POST['familia'];
        $sql = "SELECT * FROM producto WHERE familia = :familia";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':familia'=> $familia]);
    }

} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}
if($consulta != null){
    echo '<table>
    <th>Cod</th>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>PVP</th>
    <th>Familia</th>
    <th>Imagen</th>
    <th>stock</th>';
    foreach($consulta as $fila){
           
?>
            <tr>
            <td class="cod"><?php echo $fila['cod'] ?></td>
            <td class="nombre"><?php echo $fila['nombre'] ?></td>
            <td class="descripcion"><?php echo $fila['descripcion'] ?></td>
            <td class="PVP"><?php echo $fila['PVP'] ?>€</td>
            <td class="familia"><?php echo $fila['familia'] ?></td>
            <td class="imagen"><img src="imagenes/<?php echo$fila['imagen']?>" alt="Imagen"></td>
            <td class="stock"><?php echo $fila['stock'] ?></td>
            </tr>
            
<?php         
        }
    echo '</table>';   
    echo '<a href="index.html">Volver a inicio</a>'; 
}else{
    echo "La busqueda no devolvio ningun resultado";
}



}
?>