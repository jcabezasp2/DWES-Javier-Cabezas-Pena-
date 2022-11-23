<link rel="stylesheet" href="css/estilos.css">

<?php
include 'conexion.php';
if($_POST['accion'] == 'insertar'){

$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$categoria = $_POST['categoria'];
$fecha = date("Y-m-d");
if($_FILES['imagen']['name'] != ""){
$imagen = $_FILES['imagen']['full_path'];
}

try {
    $sql = "INSERT INTO noticias (titulo, texto, categoria, fecha".($_FILES['imagen']['name'] != ""?', imagen':'').") VALUES (:titulo, :texto, :categoria, :fecha".($_FILES['imagen']['name'] != ""?", :imagen":"").")";
    $consulta = $conexion->prepare($sql);
    //echo $sql;
    //var_dump($_FILES);
    if($_FILES['imagen']['name'] == ""){
        $consulta->execute([':titulo'=>$titulo, ':texto'=>$texto, ':categoria'=>$categoria, ':fecha'=>$fecha]);
    }else{
        if($_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "image/bmp"){
        $consulta->execute([':titulo'=>$titulo, ':texto'=>$texto, ':categoria'=>$categoria, ':fecha'=>$fecha, ':imagen'=>$imagen]);
        $original = $_FILES['imagen']['tmp_name'];
        $directorio = "img/";
        $destino = $imagen;
        move_uploaded_file($original, $directorio.$destino);

        }else{
            echo "ERROR, Formato no admitido";
        }
        
    }


} catch (PDOException $e) {
    echo "ERROR:" . $e->getMessage();
}


}

if($_POST['accion'] == 'borrar'){

    $repeticiones = count($_POST['ids']);

    for($i = 0; $i <= $repeticiones; $i++){
        $id = $_POST['ids'][$i];
        try {
            $sql = "DELETE FROM noticias WHERE id = :id";
            //echo $sql;
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':id'=>$id]);
            
        
        
        } catch (PDOException $e) {
            echo "ERROR:" . $e->getMessage();
        }
    }




}







if(!isset($_POST['modo']) || $_POST['accion'] == 'volver1'){
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>Gestion de noticias</h1>
    <label for="tipo">Elegir accion:</label>

<select name="modo" id="modo">
    <option value="consultar">Consultar</option>
    <option value="insertar">Insertar</option>
    <option value="borrar">Borrar</option>
</select>
<input type="submit" name="enviar1" value="Enviar">
</fieldset>
</form>






<?php

}


else if($_POST['modo'] == "consultar"){
    $stmt = $conexion -> query("SELECT DISTINCT categoria FROM noticias");

?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>Consulta de noticias</h1>
    <label for="tipo">Consulta de noticias:</label>
    <input type="hidden" name="modo" value="consultar2">
<select name="tipo" id="tipos" required>
    <option value="todas">Todas</option>

<?php

   while($fila = $stmt->fetch(PDO::FETCH_OBJ)){
    echo '<option value='.$fila->categoria.'>'.$fila->categoria.'</option>';
   }


?>
    

</select>

    <input type="submit" name="enviar" value="Enviar">
    <button type="submit" name="accion" value="volver1">Volver</button>

</fieldset>
</form>


<?php

   
}else if($_POST['modo'] == 'consultar2'){
    
    $consulta = 'SELECT * FROM noticias';

    if($_POST['tipo'] != 'todas'){
        
        $consulta .= ' WHERE categoria like "'.$_POST['tipo'].'"';

    }

    $consulta .= ' ORDER BY fecha DESC';
 
$stmt = $conexion ->query($consulta);
?>

<table>
    <tr>
        <th class="titulo">Titulo</th>
        <th class="texto">Texto</th>
        <th class="categoria">Categoria</th>
        <th class="fecha">Fecha</th>
        <th class="imagen">Imagen</th>
    </tr>
    
<?php

while( $fila = $stmt ->fetch(PDO::FETCH_OBJ)){
    echo '
    <tr>
    <td class="titulo">'.$fila->titulo.'</td>
    <td class="texto">'.$fila->texto.'</td>
    <td class="categoria">'.$fila->categoria.'</td>
    <td class="fecha">'.strftime("%d/%m/%G", strtotime($fila->fecha)).'</td>
    <td class="imagen"><a target="_blank" href="img/'.$fila->imagen.'">'.(($fila->imagen != "")?'<img src="img/ico-fichero.gif" alt"">': '').'</a></td>
    </tr>
    ';
}



?>

</table>
<form id="volver" action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<button type="submit" name="accion" value="volver">Volver</button>
</form>

<?php


}  

else if($_POST['modo'] == "insertar"){

    $stmt = $conexion -> query("SELECT DISTINCT categoria FROM noticias");

?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post" enctype='multipart/form-data'>
<fieldset>
<h1>Modificacion de noticias</h1>
<p>
<label for="titulo">Introduzca un titulo:</label>
<input type="text" name="titulo" class="entrada" id="titulo" value="<?php if(isset($_POST['titulo'])){echo $_POST['titulo'];}?>" required>
</p>
<p>
<label for="texto">Introduzca un texto:</label>
<input type="textarea" rows="5" cols="33" name="texto" class="entrada" id="texto" value="<?php if(isset($_POST['texto'])){echo $_POST['texto'];}?>" required>
</p>
<p>
<select name="categoria" id="categoria" required>

<?php

   while($fila = $stmt->fetch(PDO::FETCH_OBJ)){
    echo '<option value='.$fila->categoria.'>'.$fila->categoria.'</option>';
   }


?>
</select>
</p>
<p>
<input type="file" class="entrada" name="imagen" id="imagen">
</p>
<button type="submit" name="accion" value="insertar">Insertar</button>
<button type="submit" name="accion" value="volver">Volver</button>
</fieldset>
</form>
<?php


}  

else if($_POST['modo'] == "borrar"){

    $consulta = 'SELECT * FROM noticias';    
    $consulta .= ' ORDER BY fecha DESC';
    
    $stmt = $conexion ->query($consulta);
    
    
    
?>

<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<fieldset>
<h1>Borrado de noticias</h1>


<table>
<tr>
    <th class="titulo">Titulo</th>
    <th class="texto">Texto</th>
    <th class="categoria">Categoria</th>
    <th class="fecha">Fecha</th>
    <th class="imagen">Imagen</th>
    <th class= "check">Check</th>
</tr>

<?php

while( $fila = $stmt ->fetch(PDO::FETCH_OBJ)){

echo '
<tr>
<td class="titulo">'.$fila->titulo.'</td>
<td class="texto">'.$fila->texto.'</td>
<td class="categoria">'.$fila->categoria.'</td>
<td class="fecha">'.strftime("%d/%m/%G", strtotime($fila->fecha)).'</td>
<td class="imagen"><a target="_blank" href="img/'.$fila->imagen.'">'.(($fila->imagen != "")?'<img src="img/ico-fichero.gif" alt"">': '').'</a></td>
<td><input type="checkbox"  name="ids[]" value='.$fila->id.'/></td>
</tr>
';
}



?>

</table>



<button type="submit" name="accion" value="borrar">borrar</button>
</fieldset>
</form>
<?php


}

    
?>